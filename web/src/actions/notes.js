import axios from 'axios';
import config from 'configuration';
import { message } from 'antd';

import { getToken, setCookie, tokenGetClaims } from 'utils'

export async function uploadNote(data) {
  return new Promise((resolve, reject) => {
    axios({method: "POST", url:config.API_URL + config.routes.create.note, data:{class: data.class, description: data.description, title: data.title}, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((response) => {

      let rdata = response.data;
      let signedUrl = rdata.signedUrl;
      let key = rdata.key;
      axios({
        method: "PUT",
        url: signedUrl,
        data: data.file.file.originFileObj,
        headers: { 'Content-Type': 'application/pdf' }
      }).then((response) => {
        console.log(response);
        message.success("Succesfully uploaded note!");
        resolve(response);
      }).catch((error) => {
        console.error(error);
        message.error("Failed to upload note, try again later");
        reject(error);
      });

    }).catch((error) => {
      message.error("Failed to upload note, try again later");
      console.error(error);
      reject(error);
    });
  });
}

export async function getTopNotes(count = 5) {
  return new Promise((resolve, reject) => {
    axios({method: "GET", url:config.API_URL + config.routes.notes.getTopNotes + "?count=" + count, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((response) => {
      resolve(response);
    }).catch((error) => {
      message.error("Failed to retrieve popular notes");
      reject(error);
    });
  });
}

export async function getLatestNotes(count = 5) {
  return new Promise((resolve, reject) => {
    axios({method: "GET", url:config.API_URL + config.routes.notes.latest + "?count=" + count, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((response) => {
      resolve(response);
    }).catch((error) => {
      message.error("Failed to retrieve latest notes");
      reject(error);
    });
  });
}

export async function getNote(id) {
  return new Promise((resolve, reject) => {
    if (id === undefined) {
      reject(new Error("No ID given"));
    }
    axios({method: "GET", url:config.API_URL + config.routes.notes.note + "?id=" + id, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((res) => {
      resolve(res);
    }).catch((error) => {
      message.error("Failed to retrieve note");
      reject(error);
    });
  });
}

export async function updateDownloadCount(id) {
  return new Promise((resolve, reject) => {
    if (id === undefined) {
      reject(new Error("No ID given"));
    }
    axios({method: "PATCH", url:config.API_URL + config.routes.notes.note,
    headers: {
      Authorization: `Bearer ${getToken()}`
    },
      data: {note_id: id}
    }).then((res) => {
      resolve(res);
    }).catch((error) => {
      console.error("Failed to update note stats");
      reject(error);
    });
  });
}

export async function searchNotes(query) {
  return new Promise((resolve, reject) => {
    axios({method: "GET", url:config.API_URL + config.routes.notes.search + "?search_query=" + query, headers: {
      Authorization: `Bearer ${getToken()}`
    }}).then((response) => {
      resolve(response);
    }).catch((error) => {
      message.error("Failed to retrieve notes");
      reject(error);
    });
  });
}

/*
  Rating: {rating: number, note_id: number}
*/
export async function rateNote(rating) {
  return new Promise((resolve, reject) => {
    if (rating === undefined) {
      reject(new Error("No rating given"));
    }
    axios({
      method: "POST",
      url: config.API_URL + config.routes.notes.ratings,
      data: rating,
      headers: {
        Authorization: `Bearer ${getToken()}`
      }
    }).then((res) => {
      message.success("Succesfully rated note");
      resolve(res);
    }).catch((error) => {
      message.error("Failed to rate note");
      reject(error);
    });
  });
}

export async function getMyRating(noteID) {
  return new Promise((resolve, reject) => {
    if (noteID === undefined) {
      reject(new Error("No rating given"));
    }
    axios({
      method: "GET",
      url: config.API_URL + config.routes.notes.ratings + "?note_id=" + noteID,
      headers: {
        Authorization: `Bearer ${getToken()}`
      }
    }).then((res) => {
      resolve(res.data);
    }).catch((error) => {
      message.error("Failed to get your rating");
      reject(error);
    });
  });
}
