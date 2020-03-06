import React, { useState, useEffect } from 'react';
import { Rate, Skeleton } from 'antd';
import { Link } from 'react-router-dom';
import NoteCard from 'components/Notes/NoteCard';
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
          <NoteCard {...row} key={i} />
        )
      })
    }
    {props.loading && <Skeleton active/>}
    </div>
  )
}

export default NotesList
