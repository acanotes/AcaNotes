import React, { useState, useEffect } from 'react';
import { Rate, Skeleton } from 'antd';
import './index.less';

const randomColors= (c) => {
  let colors = ["#e66465", "#9198e5", "#3f87a6", "#ebf8e1", "#ff9f1c", "#2ec4b6", "#cad695", "#6d5f64"];
  if (c) {
    colors.splice(colors.indexOf(c), 1);
  }
  let randIndex = Math.floor(Math.random() * colors.length);
  return colors[randIndex];
}

const UserList = (props) => {

  return (
    <div className="UserList">
      {props.users && props.users.length && props.users.map((row, i) => {
        let i1 = randomColors();
        let i2 = randomColors(i1);
        let c = "linear-gradient(" + Math.random() + "turn, " + i1  + ", " + i2 + ")";
        console.log(c);
        return (
          <div key={i} className="user-card">
            <div className="stand-in-avatar" style={{background:c}}></div>
            <div className="user-name">Name: {row.user_first}</div>
            <div className="user-title">Title: {row.user_title}</div>
            <div className="user-rating"><Rate disabled value={row.user_rating}/></div>
            <div className="user-downloads">Downloads: {row.user_downloads}</div>
          </div>
        )
      })
      }
      {props.loading && <Skeleton active/>}
    </div>
  )
}

export default UserList
