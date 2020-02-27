import axios from 'axios';
import config from 'configuration';

export async function verifyToken(token) {
  return new Promise((resolve, reject) => {
    axios.post(config.API_URL + config.routes.auth.verify, {token: token}).then( async (response: any) => {
      let resData = response.data;
      console.log()
      resolve(resData);
    }).catch((error: Error) => {
      reject(error);
    });
  });
}
