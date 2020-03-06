import React, { useState, useEffect } from 'react';

import './index.less';

const Card = (props) => {

  return (
    <div className="AcaCard">
      {props.children}
    </div>
  )
}

export default Card
