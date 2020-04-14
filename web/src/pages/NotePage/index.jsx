import React, { useEffect, useState } from 'react';
import { pdfjs } from 'react-pdf';

import { Document, Page } from 'react-pdf';
import RateNote from 'components/Notes/RateNote';
import DownloadNote from 'components/Notes/DownloadNote';
import MainLayout from 'layouts/MainLayout';
import Header from 'components/Header';
import { getNote } from 'actions/notes';
import {Document, Page} from 'react-pdf';

import { errorLogger } from 'utils';

import './index.less';
pdfjs.GlobalWorkerOptions.workerSrc = `//cdnjs.cloudflare.com/ajax/libs/pdf.js/${pdfjs.version}/pdf.worker.js`;

const NotePage = (props) => {
  const [noteID, setID] = useState(props.match.params.id);
  const [fileURI, setFileURI] = useState("a");
  const [note, setNote] = useState({});
  const [myRating, setMyRating] = useState(0);
  const [pdfWidth, setWidth] = useState();
  
  useEffect(() => {
    setID(props.match.params.id);
    getNote(props.match.params.id).then((res) => {
      setFileURI(res.data.signedUrl);
      setNote(JSON.parse(res.data.note));
    }).catch((error) => {
      errorLogger(error);
    });
    window.addEventListener("resize", () => {
      resizePDF();
    });
  }, []);
  const resizePDF = () => {
    setWidth(document.getElementsByClassName('main-container')[0].clientWidth);
  }
  return (
    <MainLayout>
      <div className="NotePage">
      <Header title="Note"/>

        <div className="main-container">
          <h2 className="title">{note.a_title}</h2>
          <div className="note-meta">
          <p className="author">Author: <a href={'/users/' + note.a_author}>{note.a_author}</a></p>
          <p className="subject">Subject: <a href={'#'}>{note.a_subject}</a></p>
          <p className="desc">Description: {note.a_description}</p>
          <p className="downloads">Downloads: {note.a_downloads}</p>
          <p className="rating">Average Rating: {note.a_rating}/5</p>
          <p>Rate this note</p>
          <RateNote value={myRating} note_id={noteID} />
          </div>

          <DownloadNote fileURI={fileURI} note_id={noteID} />

          <center>
            <h3>Preview document: </h3>

          <div className='pdf-wrapper'>
            <Document file={fileURI} className="doc" onLoadSuccess={() => {
              resizePDF();
            }}>
              <Page pageNumber={1} className='doc-page' width={pdfWidth} height={pdfWidth}/>
            </Document>
          </div>

          </center>


        </div>
      </div>
    </MainLayout>
  );
}

export default NotePage
