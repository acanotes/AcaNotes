import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import './index.less';

const Footer = () => {

  return (
    <div className="Footer">
      Copyright © {(new Date).getFullYear()} AcaNotes.com |
      <a href='/contributors'>Contributors</a> |
      <a href='https://www.facebook.com/acanotes/' target="_blank" >Facebook</a> | 
      <a href='https://www.instagram.com/acanotes/' target="_blank" >Instagram</a>
    </div>
  )
}

export default Footer
