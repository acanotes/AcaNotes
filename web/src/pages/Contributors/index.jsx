import React from 'react';
import { Button } from 'antd';
import MainLayout from 'layouts/MainLayout';

import './index.less';

const ContributorsPage = () => {
  return (
    <MainLayout>
      <div className="ContributorsPage">
        <div className="main-container">
        <h2>Founding Members</h2>
        <p>Andrew Liu</p>
        <p>Vincent Cai</p>
        <p>Stone Tao</p>
        <p>Tom Jiao</p>
        <p>Alex Xu</p>
        <p>Emma Liu</p>
        <p>David Yei</p>
        <br/>
        <h2>Current management team</h2>
        <br/>
        <h2>Project contributors</h2>
        <br/>
        <h2>Honorary Members</h2>
        <br/>
        </div>
      </div>
    </MainLayout>
  )
}

export default ContributorsPage
