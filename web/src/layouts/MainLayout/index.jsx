import React from 'react';
import Navbar from 'components/Navbar';

import './index.less';

const MainLayout = (props) => {
  return (
    <div className="MainLayout">
      <Navbar />
      {props.children}
    </div>
  )
}

export default MainLayout
