import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { Rate, Skeleton } from 'antd';
import Avatar from '../Avatar';
import './index.less';

const randomColors= (c) => {
  let colors = ["#e66465", "#9198e5", "#3f87a6", "#ebf8e1", "#ff9f1c", "#2ec4b6", "#cad695", "#6d5f64"];
  if (c) {
    colors.splice(colors.indexOf(c), 1);
  }
  let randIndex = Math.floor(Math.random() * colors.length);
  return colors[randIndex];
}

const UserCard = (props) => {
  let i1 = randomColors();
  let i2 = randomColors(i1);
  let c = "linear-gradient(" + Math.random() + "turn, " + i1  + ", " + i2 + ")";
  return (
    <Link className="UserCard" to={"/users/" + props.user_uid}>
      <Avatar background={props.user_image}/>
      <div className="user-name">Name: {props.user_first}</div>
      <div className="user-title">Title: {props.user_title}</div>
      <div className="user-rating"><Rate disabled value={props.user_rating}/></div>
      <div className="user-downloads">Downloads: {props.user_downloads}</div>
    </Link>
  )
}

export default UserCard
