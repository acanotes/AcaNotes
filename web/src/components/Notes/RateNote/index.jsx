import React, { useState, useEffect } from 'react';
import { Rate } from 'antd';
import { rateNote, getMyRating } from 'actions/notes';
import { errorLogger } from 'utils';

import './index.less';

// Allows rating of a note, props { note_id: required }
const RateNote = (props) => {
  const [myRating, setMyRating] = useState(0);
  useEffect(() => {
    if (props.note_id) {
      getMyRating(props.note_id).then((res) => {
        let rating = res.rating;
        if (rating) {
          rating = JSON.parse(rating);
          setMyRating(rating.rating_value);
        }
      }).catch((error) => {
        
      })
    }
  }, [props.note_id])
  return (
    <div className="RateNote">
      <Rate value={myRating} onChange={
        (val) => {
          rateNote({note_id: props.note_id, rating: val}).then((res) => {

          }).catch((error) => {
            errorLogger(error);
            setMyRating(0);
          })
          setMyRating(val);
        }
      }
      />
    </div>
  )
}

export default RateNote
