import React from 'react';
import { Button } from 'antd';
import MainLayout from 'layouts/MainLayout';

import mascot from 'assets/mascot.png';
import './index.less';

const MainPage = () => {
  return (
    <MainLayout>
      <div className="MainPage">
        <div className="hero-container">
          <div className="container">
            <h1 className="title">AcaNotes</h1>
            <p className="sub-title">The ultimate online note-sharing platform designed specifically for IB students. </p>
          </div>
        </div>
        <div className="container">
          <h2>Students for students.</h2>
          <p> AcaNotes is a resource that provides IB students with course notes from credible sources. Dedicated to help you achieve optimal results, we value your success over anything else. Here at AcaNotes, every student is a priority. </p>
          <div className="mascot-wrapper">
            <img src={mascot} className="mascot"/>
          </div>
        </div>
        <div className="container">
          <h2>We are directed at IB</h2>
          <p>Unlike Gradesaver or Litcharts, we are directed at the IB curriculum, with our resources coming straight from IB students who have exceled under the IB curriculum. </p>
        </div>
        <div className="container">
          <div className="signup-btn-wrapper">
            <a href="/register">
              <Button type="primary" className="signup-btn">SIGN UP NOW</Button>
            </a>
          </div>
        </div>
      </div>
    </MainLayout>
  )
}

export default MainPage
