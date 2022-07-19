import React from "react";
import { useTheme } from "@mui/material/styles";

//Use For CSS styling
import useStyle, { FormInputSelect } from "./styles";

//import Material UI design
import {
    Container,
    Select,
    MenuItem,
} from "@mui/material";

//Custom <P> as <Paragraph>
import Paragraph from "../typography/Paragraph";

//Uses a spnne/loader to indicate loading
import Loader from "react-js-loader";

//import the API
import {
    send_email,
    get_email,
} from "../API/API";

const Home = () => {
    const classes = useStyle();
    const theme = useTheme();

    //Loader
    const [loading, setLoading] = React.useState(false);

    //Sort
    const [sortList, setSortList] = React.useState(0);

    const handleChangeSort = (event) => {
        setSortList(event.target.value);
    };

    const [userData, setUserData] = React.useState([]);

    const getUserData = () => {
        let postparm = {
            is_sort: sortList,
        };
        get_email(postparm).then((json) => {
            setUserData(json.data);
        })
    }

    //Send Email
    const [emailData, setEmailData] = React.useState({
        email: "",
    });

    const handleChangeEmail = (event) => {
        setEmailData(event.target.value);
    };

    //Submit Email
    const handleSubmitEmail = () => {
        send_email({ email: emailData }).then((json) => {
            if (json.status) {
                alert("Check your Email ;)");
            } else {
                alert(json.message);
            }
        })
    }

    React.useEffect(() => {
        getUserData();
    }, [sortList]);





    return (
        <React.Fragment>
            <Container maxWidth="md" style={{ transform: "translate(0,50%)" }}>
                {loading == true ? (
                    <Loader type="bubble-loop" bgColor={"#23528c"} size={50} />
                ) : (
                    <>
                        <Paragraph color="#252E62" size="48px" bold="bold" margin="0 0 1rem 0">
                            Chuck Norris is in your Email
                        </Paragraph>
                        <div className={classes.thePadding}>
                            <Paragraph color="#252E62" size="24px" bold="500" margin="0 0 0.5rem 0">
                                Sort By
                            </Paragraph>
                            <FormInputSelect>
                                <Select
                                    onChange={handleChangeSort}
                                    displayEmpty
                                    inputProps={{ "aria-label": "Without label" }}
                                    value={sortList}
                                    defaultValue={sortList}
                                >
                                    <MenuItem value={0}>
                                        By Name
                                    </MenuItem>
                                    <MenuItem value={1}>
                                        By Domain
                                    </MenuItem>
                                    <MenuItem value={2}>
                                        By Domain and Name
                                    </MenuItem>
                                </Select>
                            </FormInputSelect>
                            <br />
                            <br />
                            <Paragraph color="#252E62" size="24px" bold="500" margin="0 0 0.5rem 0">
                                Email
                            </Paragraph>
                            <FormInputSelect>
                                <Select
                                    onChange={handleChangeEmail}
                                    displayEmpty
                                    inputProps={{ "aria-label": "Without label" }}
                                    value={userData.email}
                                >
                                    {userData.map((item) => (
                                        <MenuItem value={item.email}>
                                            {item.email}
                                        </MenuItem>
                                    ))}
                                </Select>
                            </FormInputSelect>

                            <br />
                            <br />

                            <div className={classes.theButton}>
                                <Paragraph center color="#FFFFFF" size="24px" bold="500" onClick={() => handleSubmitEmail()}>
                                    Submit
                                </Paragraph>
                            </div>
                        </div>
                    </>
                )}
            </Container>
        </React.Fragment>
    )
}
export default Home;
