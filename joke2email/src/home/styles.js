import styled from "styled-components/macro";
import { makeStyles } from "@mui/styles";
import { FormControl } from "@mui/material";

export const FormInputSelect = styled(FormControl)`
  display: block;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #eaeaea;
  border-radius: 6px;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  width: 100%;
  .MuiInput-underline:before {
    border-bottom: none !important;
  }
  .MuiInput-underline:after {
    border-bottom: none !important;
  }
  .MuiInputBase-root {
    width: 100%;
  }
  .MuiInputBase-root {
    font-weight: 500 !important;
  }
  .MuiInput-underline {
    &:before {
      position: relative !important;
    }
  }
`;


const config = {

    thePadding: {
        padding: "2rem",
        boxShadow: '0px 0px 10px 1px rgba(0, 0, 0, 0.2)'
    },

    theButton: {
        cursor: "pointer",
        background: "#252E62",
        borderRadius: "0.75rem",
        padding: "0.5rem",
    }

};

export default makeStyles(config);
