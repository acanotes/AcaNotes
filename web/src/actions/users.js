import axios from 'axios';
import config from 'configuration';
import { message } from 'antd';

import { getToken, setCookie, tokenGetClaims } from 'utils'

export async function getTop(count = 5) {
  return new Promise((resolve, reject) => {
    axios({method: "GET", url:config.API_URL + config.routes.users.getTop + "?count=" + count, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((response) => {
      resolve(response);
    }).catch((error) => {
      message.error("Failed to retrieve top users");
      reject(error);
    });
  });
}
