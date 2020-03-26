import React, { useEffect, useState } from 'react';
import { Document } from 'react-pdf/dist/entry.webpack';
import { Button, Rate } from 'antd';
import { DownloadOutlined } from '@ant-design/icons';
import {Helmet} from "react-helmet";
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
        <Helmet>
            <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.2.228/build/pdf.min.js" async = "true"></script>
        </Helmet>
        <div className="main-container">
          <h2 class="title">{note.a_title}</h2>
          <div className="note-meta">
          <p class="author">Author: <a href={'/users/' + note.a_author}>{note.a_author}</a></p>
          <p class="subject">Subject: <a href={'#'}>{note.a_subject}</a></p>
          <p class="desc">{note.a_description}</p>
          <p class="downloads">{note.a_downloads}</p>
          <p class="rating">Average Rating: {note.a_rating}/5</p>
          <p>Rate this note</p>
          <Rate value={myRating} onChange={(val) => setMyRating(val)} />
          </div>

          <div className="pdf-wrapper">
          <h3>Preview</h3>

          <canvas id="pdf-view"></canvas>

          {

            pdfjsLib.getDocument(fileURI).then(doc => {
              doc.getPage(1).then(page => {
                var pdfView = document.getElementById("pdf-view");
                var context = pdfView.getContext("2d");

                var viewport = page.getViewport(1.5); //size of canvas
                pdfView.width = viewport.width;
                pdfView.height = viewport.height;

                page.render({
                  canvasContext: context,
                  viewport: viewport
                })
  
              });
            })
          }

          <div className="download-row">
            <DownloadOutlined />
            <a href={fileURI} target="_blank">Download</a>
          </div>
          </div>
        </div>
      </div>
    </MainLayout>
  );
}

export default NotePage
