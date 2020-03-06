import React, { useEffect, useState } from 'react';
import { Button } from 'antd';
import MainLayout from 'layouts/MainLayout';
import Avatar from 'components/User/Avatar';
import NotesList from 'components/Notes/NotesList';
import { useParams, Link } from 'react-router-dom';
import { getUser, getPopularUploads, getUserImage } from 'actions/users';

import UserContext from 'UserContext.js';
import { errorLogger } from 'utils';

import './index.less';

const ProfilePage = () => {
  const params = useParams();
  const userHooks = React.useContext(UserContext);
  const [profile, setProfile] = useState({});
  const [popularUploads, setPopularUploads] = useState([]);
  const [profilePic, setProfilePic] = useState("");
  const mine = params.id === userHooks.user.username;

  useEffect(() => {

    getUser(params.id).then((res) => {
      console.log(res);
      setProfile(res);
    }).catch((error) => {
      errorLogger(error);
    })
    getUserImage(params.id).then((res) => {
      setProfilePic(res);
    }).catch(errorLogger)
    getPopularUploads(params.id).then((res) => {
      setPopularUploads(res);
    }).catch(errorLogger)
  }, []);
  return (
    <MainLayout>
      <div className="ProfilePage">
        <div className="main-container">
          <div className="profile-pic-wrapper">
            <Avatar size="large" background={profilePic} className="avatar"/>
          </div>
          <h2>{profile.user_first} {profile.user_last}</h2>
          <div className="title">Honorary Title: <span>{profile.user_title}</span></div>
          <div className="rating">Rating: {profile.user_rating || 0}/5</div>
          <div className="downloads">User Downloads: {profile.user_downloads}</div>
          <div className="desc">Description: <p>{profile.user_description || "User has no description"}</p></div>
          <div className="popular-uploads">
            <div className="title">Popular Uploads</div>
            {popularUploads ? <NotesList notes={popularUploads}/> : <p>This user has no uploads available</p>}
          </div>
          { mine && <Link to={"/editProfile"}><Button size="large">Edit Profile</Button></Link> }
        </div>
      </div>
    </MainLayout>
  )
}

export default ProfilePage
