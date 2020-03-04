import React, { useEffect, useState } from 'react';
import { Button } from 'antd';
import MainLayout from 'layouts/MainLayout';
import NotesList from 'components/Notes/NotesList';
import { useParams } from 'react-router-dom';
import { getUser, getPopularUploads } from 'actions/users';

import UserContext from 'UserContext.js';
import { errorLogger } from 'utils';

import './index.less';

const ProfilePage = () => {
  const params = useParams();
  const userHooks = React.useContext(UserContext);
  const [profile, setProfile] = useState({});
  const [popularUploads, setPopularUploads] = useState([]);
  useEffect(() => {

    getUser(params.id).then((res) => {
      setProfile(res);
      console.log(res);
    }).catch((error) => {
      errorLogger(error);
    })
    getPopularUploads(params.id).then((res) => {
      console.log(res);
      setPopularUploads(res);
    }).catch(errorLogger)
  }, []);
  return (
    <MainLayout>
      <div className="ProfilePage">
        <div className="main-container">
          <h2>{profile.user_first} {profile.user_last}</h2>
          <div className="title">Honorary Title: {profile.user_title}</div>
          <div className="rating">Rating: {profile.user_rating || 0}/5</div>
          <div className="downloads">User Downloads: {profile.user_downloads}</div>
          <div className="desc">Description: {profile.user_description}</div>
          <div className="popular-uploads">
            <div className="title">Popular Uploads</div>
            <NotesList notes={popularUploads}/>
          </div>
        </div>
      </div>
    </MainLayout>
  )
}

export default ProfilePage
