//Local Database
const host = "http://localhost/chuck_norris/";
const access_endpoint_link = host + "API/";

//Link to Endpoint (Bridge)
const format_request = (postparam) => {
  let body = "";
  for (let k in postparam) {
    body += encodeURI(k) + "=" + encodeURI(postparam[k]) + "&";
  }

  var postOptions = {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: body,
  };
  return postOptions;
};


const api_post = async (postparam = {}, end_point) => {
  var response = await fetch(
    access_endpoint_link + end_point,
    format_request(postparam)
  );

  var json = await response.json();
  if (json.status) {
    return json;
  } else {

    return json;
  }
};

//API Call
export const get_email = async (postparam) => {
  return api_post(postparam, "get_email ");
};

export const send_email = async (postparam) => {
  return api_post(postparam, "send_email ");
};


