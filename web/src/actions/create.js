import axios from 'axios';
import config from 'configuration';
import { message } from 'antd';

import { getToken, setCookie, tokenGetClaims } from 'utils'

export async function uploadNote(data) {
  return new Promise((resolve, reject) => {
    axios({method: "POST", url:config.API_URL + config.routes.create.note, data:data, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((response) => {

      message.success("Succesfully uploaded note!");
      resolve(response);
    }).catch((error) => {
      message.error("Failed to upload note, try again later");
      reject(error);
    });
  });
}
