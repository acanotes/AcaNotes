import React, { useState, useEffect } from 'react';
import { Rate, Skeleton } from 'antd';
import UserCard from '../UserCard';
import './index.less';

const UserList = (props) => {

  return (
    <div className="UserList">
      {props.users && props.users.length && props.users.map((row, i) => {
        return (
          <UserCard key={i} {...row}/>
        )
      })
      }
      {props.loading && <Skeleton active/>}
    </div>
  )
}

export default UserList
