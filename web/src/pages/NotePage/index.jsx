import React, { useEffect, useState } from 'react';
import { Document } from 'react-pdf/dist/entry.webpack';
import { Button } from 'antd';
import RateNote from 'components/Notes/RateNote';
import { DownloadOutlined } from '@ant-design/icons';
import MainLayout from 'layouts/MainLayout';
import Header from 'components/Header';
import { getNote, updateDownloadCount } from 'actions/notes';

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
  const updateDownloads = () => {
    updateDownloadCount(props.match.params.id).then(() => {

    }).catch(errorLogger)
  }
  return (
    <MainLayout>
      <div className="NotePage">
      <Header title="Note"/>
        <div className="main-container">
          <h2 class="title">{note.a_title}</h2>
          <div className="note-meta">
          <p class="author">Author: <a href={'/users/' + note.a_author}>{note.a_author}</a></p>
          <p class="subject">Subject: <a href={'#'}>{note.a_subject}</a></p>
          <p class="desc">Description: {note.a_description}</p>
          <p class="downloads">Downloads: {note.a_downloads}</p>
          <p class="rating">Average Rating: {note.a_rating}/5</p>
          <p>Rate this note</p>
          <RateNote note_id={note.a_id} />
          </div>

          <div className="pdf-wrapper">
            <iframe
           className="pdf-viewer"
             src={fileURI}
           >
           </iframe>

          <div className="download-row">
            <DownloadOutlined />
            <a href={fileURI} target="_blank" onClick={updateDownloads}>Download</a>
          </div>
          </div>
        </div>
      </div>
    </MainLayout>
  )
}

export default NotePage
