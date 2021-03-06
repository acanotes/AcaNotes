import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import './index.less';
import { FacebookOutlined, TeamOutlined, InstagramOutlined } from '@ant-design/icons';

const Footer = () => {

  return (
    <div className="Footer">
      <div className="icons-wrapper">
        <a href='/contributors'>
          <TeamOutlined className="icon"/>
        </a>
        <a href='https://www.facebook.com/acanotes/' target="_blank" >
          <FacebookOutlined className="icon"/>
        </a>
        <a href='https://www.instagram.com/acanotes/' target="_blank" >
          <InstagramOutlined className="icon"/>
        </a>
      </div>
      <div className="copyright">
        Copyright © {(new Date).getFullYear()} AcaNotes.com
      </div>
    </div>
  )
}

export default Footer
