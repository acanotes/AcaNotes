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

// Returns only public user data for given username or id
export async function getUser(user) {
  return new Promise((resolve, reject) => {
    axios({method: "GET", url:config.API_URL + config.routes.users.getUser + "?id=" + user, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((response) => {
      resolve(JSON.parse(response.data.res));
    }).catch((error) => {
      message.error("Failed to retrieve user data");
      reject(error);
    });
  });
}
export async function getUserImage(user) {
  return new Promise((resolve, reject) => {
    axios({method: "GET", url:config.API_URL + config.routes.users.getUserImage + "?id=" + user, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((response) => {
      resolve(response.data.res);
    }).catch((error) => {
      message.error("Failed to retrieve user profile picture");
      reject(error);
    });
  });
}

export async function getPopularUploads(user) {
  return new Promise((resolve, reject) => {
    axios({method: "GET", url:config.API_URL + config.routes.users.getPopularUploads + "?id=" + user, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((response) => {
      resolve(JSON.parse(response.data.res));
    }).catch((error) => {
      message.error("Failed to retrieve popular uploads");
      reject(error);
    });
  });
}
