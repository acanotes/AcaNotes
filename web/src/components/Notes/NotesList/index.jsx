import React, { useState, useEffect } from 'react';
import { Rate, Skeleton } from 'antd';
import { Link } from 'react-router-dom';
import './index.less';

const NotesList = (props) => {

  return (
    <div className="NotesList">
      {props.notes && props.notes.length && props.notes.map((row, i) => {
        if (row == "empty") {
          return (
            <div>No Notes!</div>
          );
        }
        return (
          <Link to={"/notes-wiki/note/" + row.a_id} className="notes-link-wrapper">
            <div key={i} className="notes-card">
              <div className="notes-title">Title: {row.a_title}</div>
              <div className="notes-rating"><Rate disabled value={row.a_rating}/></div>
              <div className="notes-author">Author: {row.a_author}</div>
              <div className="notes-date">Date: {row.a_date}</div>
              <div className="notes-desc">Description: {row.a_description}</div>
              <div className="notes-downloads">Downloads: {row.a_downloads}</div>
            </div>
          </Link>
        )
      })
    }
    {props.loading && <Skeleton active/>}
    </div>
  )
}

export default NotesList
