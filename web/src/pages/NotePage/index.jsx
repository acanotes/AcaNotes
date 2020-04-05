import React, { useEffect, useState } from 'react';
import { Document, Page } from 'react-pdf';
import { Button, Rate } from 'antd';
import RateNote from 'components/Notes/RateNote';
import DownloadNote from 'components/Notes/DownloadNote';
import { DownloadOutlined } from '@ant-design/icons';
import MainLayout from 'layouts/MainLayout';
import Header from 'components/Header';
import { getNote } from 'actions/notes';

import { errorLogger } from 'utils';

import './index.less';

const NotePage = (props) => {
  const [noteID, setID] = useState(props.match.params.id);
  const [fileURI, setFileURI] = useState("a");
  const [note, setNote] = useState({});
  const [myRating, setMyRating] = useState(0);
  useEffect(() => {
    setID(props.match.params.id);
    getNote(props.match.params.id).then((res) => {
      setFileURI(res.data.signedUrl);
      setNote(JSON.parse(res.data.note));
    }).catch((error) => {
      errorLogger(error);
    });
  }, []);
  return (
    <MainLayout>
      <div className="NotePage">
      <Header title="Note"/>

        <div className="main-container">
          <h2 class="title">{note.a_title}</h2>
          <div className="note-meta">
          <p class="author">Author: <a href={'/users/' + note.a_author}>{note.a_author}</a></p>
          <p class="subject">Subject: <a href={'#'}>{note.a_subject}</a></p>
          <p class="desc">{note.a_description}</p>
          <p class="downloads">Downloads: {note.a_downloads}</p>
          <p class="rating">Average Rating: {note.a_rating}/5</p>
          <p>Rate this note</p>
          <RateNote value={myRating} note_id={noteID} />
          </div>

          <DownloadNote fileURI={fileURI} note_id={noteID} />

          <center>
            <h3>Preview document: </h3>

          <Document file={fileURI}>
          <Page pageNumber={1} />
          </Document>

          </center>


        </div>
      </div>
    </MainLayout>
  );
}

export default NotePage
