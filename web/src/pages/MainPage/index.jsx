import React from 'react';
import { Button } from 'antd';
import Navbar from 'components/Navbar';

import './index.less';

const MainPage = () => {
  return (
    <div className="MainPage">
      <Navbar />
      <div className="main-container">
        <h1>Acanotes</h1>
      </div>
    </div>
  )
}

export default MainPage
