import React, { useState, useEffect } from 'react';
import { Rate, Skeleton } from 'antd';
import { Link } from 'react-router-dom';
import './index.less';

const NoteCard = (props) => {

  return (
    <Link to={"/notes-wiki/note/" + props.a_id} className="NoteCard">
      <div className="notes-title">Title: {props.a_title}</div>
      <div className="notes-rating"><Rate disabled value={props.a_rating}/></div>
      <div className="notes-author">Author: {props.a_author}</div>
      <div className="notes-date">Date: {props.a_date}</div>
      <div className="notes-desc">Description: {props.a_description}</div>
      <div className="notes-downloads">Downloads: {props.a_downloads}</div>
    </Link>
  )
}

export default NoteCard
