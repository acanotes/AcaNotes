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
    if (props.background != "") {
      setBg(`url("${props.background}")`);
    }
    else {
      setBg(c);
    }
  }, [props.background]);
  const [bg, setBg] = useState(c);

  const [className, setClass] = useState("Avatar");
  useEffect(() => {
    let append = "";
    switch(props.size) {
      case "large":
      case "small":
        append = props.size;
        break;
    }
    setClass("Avatar " + append + " " + props.className);
  }, []);

  return (
    <div className={className} style={{backgroundImage:bg}}>
    </div>
  )
}

export default Avatar
