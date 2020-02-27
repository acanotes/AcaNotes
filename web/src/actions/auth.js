import axios from 'axios';
export async function verifyToken(token) {
  return new Promise((resolve, reject) => {
    axios.get(config.API_URL + config.routes.auth.verify, {params: {token: token}}).then( async (response: any) => {
      let user = response.data.user;
      resolve(user);
    }).catch((error: Error) => {
      reject(error);
    });
  });
}
