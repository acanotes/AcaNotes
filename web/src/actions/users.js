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
export async function getUser(id) {
  return new Promise((resolve, reject) => {
    axios({method: "GET", url:config.API_URL + config.routes.users.user + "?id=" + id, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((response) => {
      resolve(JSON.parse(response.data.res));
    }).catch((error) => {
      message.error("Failed to retrieve user data");
      reject(error);
    });
  });
}

// Returns only public user profile picture URI given username or id
export async function getUserImage(id) {
  return new Promise((resolve, reject) => {
    axios({method: "GET", url:config.API_URL + config.routes.users.userImage + "?id=" + id, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((res) => {
      resolve(res.data.signedUrl);
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

// updates user with new contents in user variable and returns new token if updated succesfully
export async function updateUser(user) {
  return new Promise((resolve, reject) => {
    axios({method: "PATCH", url:config.API_URL + config.routes.users.user + "?id=" + user.username,
      headers: {
        Authorization: `Bearer ${getToken()}`
      },
      data: user
    }).then((response) => {
      console.log(response);
      resolve(response.data.token);
    }).catch((error) => {
      message.error("Failed to update user");
      reject(error);
    });
  });
}

// uploads user image for this user
export async function uploadUserImage(user, imageFile) {
  return new Promise((resolve, reject) => {
    axios({
      method: "PUT", url:config.API_URL + config.routes.users.userImage + "?id=" + user.username,
      headers: {
        Authorization: `Bearer ${getToken()}`
      }
    }).then((response) => {

      let rdata = response.data;
      let signedUrl = rdata.signedUrl;
      let key = rdata.key;
      axios({
        method: "PUT",
        url: signedUrl,
        data: imageFile,
        headers: { 'Content-Type': 'application/image' }
      }).then((response) => {
        console.log(response);
        message.success("Succesfully uploaded profile picture!");
        resolve(response);
      }).catch((error) => {
        console.error(error);
        message.error("Failed to upload picture, try again later");
        reject(error);
      });

    }).catch((error) => {
      message.error("Failed to upload picture, try again later");
      console.error(error);
      reject(error);
    });
  });
}
