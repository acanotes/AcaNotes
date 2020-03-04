import React, { useState, useEffect } from 'react';
import './index.less';

const randomColors= (c) => {
  let colors = ["#e66465", "#9198e5", "#3f87a6", "#ebf8e1", "#ff9f1c", "#2ec4b6", "#cad695", "#6d5f64"];
  if (c) {
    colors.splice(colors.indexOf(c), 1);
  }
  let randIndex = Math.floor(Math.random() * colors.length);
  return colors[randIndex];
}

const Avatar = (props) => {
  let i1 = randomColors();
  let i2 = randomColors(i1);
  let c = "linear-gradient(" + Math.random() + "turn, " + i1  + ", " + i2 + ")";
  useEffect(() => {
    if (props.background) {
      setBg(props.background);
    }
  }, [props.background]);
  const [bg, setBg] = useState(c);
  return (
    <div className="Avatar" style={{background:bg}}>
    </div>
  )
}

export default Avatar
