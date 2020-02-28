import React from 'react';
import Navbar from 'components/Navbar';
import Footer from 'components/Footer';

import './index.less';

const MainLayout = (props) => {
  return (
    <div className="MainLayout">
      <Navbar />
      {props.children}
      <Footer />
    </div>
  )
}

export default MainLayout
