import axios from 'axios';
import config from 'configuration';
import { message } from 'antd';

import { getToken, setCookie, tokenGetClaims } from 'utils'

export async function getAnnouncements(count = 1) {
  return new Promise((resolve, reject) => {
    axios({method: "GET", url:config.API_URL + config.routes.announcements.latest + "?count=" + count, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((response) => {
      resolve(response);
    }).catch((error) => {
      message.error("Failed to retrieve announcements");
      reject(error);
    });
  });
}
