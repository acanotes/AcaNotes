import React from 'react';
import { Button } from 'antd';
import MainLayout from 'layouts/MainLayout';

import './index.less';

const TodayPage = () => {
  return (
    <MainLayout>
      <div className="TodayPage">
        <div className="main-container">
        <h1>Acanotes</h1>
        </div>
      </div>
    </MainLayout>
  )
}

export default TodayPage
