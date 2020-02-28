import React from 'react';
import { Button } from 'antd';
import MainLayout from 'layouts/MainLayout';

import './index.less';

const MainPage = () => {
  return (
    <MainLayout>
      <div className="MainPage">
        <div className="main-container">
          <h1>Acanotes</h1>
        </div>
      </div>
    </MainLayout>
  )
}

export default MainPage
