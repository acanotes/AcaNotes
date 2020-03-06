import React, { useState, useEffect } from 'react';

import './index.less';

const Header = (props) => {

  return (
    <div className="Header">
      {props.title}
    </div>
  )
}

export default Header
