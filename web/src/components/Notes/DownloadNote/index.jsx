import React, { useState, useEffect } from 'react';
import { DownloadOutlined } from '@ant-design/icons';
import { Link } from 'react-router-dom'
import { Button, message } from 'antd';
import './index.less';
import { recordDownload } from 'actions/notes';

const DownloadNote = (props) => {

  return (
    <div className="DownloadNote">
      <Button className='download-btn' onClick={() => {
        recordDownload(props.note_id).then(() => {  
          window.open(props.fileURI, 'toolbar=0,location=0,menubar=0')
        }).catch((error) => {
          message.error('There was an issue trying to retrieve the note')
        })
      }}><DownloadOutlined /> Download</Button>
    </div>
  )
}

export default DownloadNote
