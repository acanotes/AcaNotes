import React, { useEffect, useState } from 'react';
import { Button, Rate } from 'antd';
import MainLayout from 'layouts/MainLayout';
import Header from 'components/Header';
import UserContext from 'UserContext';

import { getAnnouncements } from 'actions/announcements';
import { getTop } from 'actions/users';
import { getTopNotes, getLatestNotes } from 'actions/notes';

import './index.less';

const randomColors= (c) => {
  let colors = ["#e66465", "#9198e5", "#3f87a6", "#ebf8e1", "#ff9f1c", "#2ec4b6", "#cad695", "#6d5f64"];
  if (c) {
    colors.splice(colors.indexOf(c), 1);
  }
  let randIndex = Math.floor(Math.random() * colors.length);
  return colors[randIndex];
}

const TodayPage = () => {
  const [announcements, setAnnouncements] = useState([]);
  const [topUsers, setTopUsers] = useState([]);
  const [topNotes, setTopNotes] = useState([]);
  const [latestNotes, setLatestNotes] = useState([]);
  const userHooks = React.useContext(UserContext);
  useEffect(() => {
    getAnnouncements(3).then((res) => {
      console.log(res.data);
      setAnnouncements(JSON.parse(res.data.res));
    });

  }, [])
  useEffect(() => {
    getTop(5).then((res) => {
      setTopUsers(JSON.parse(res.data.res));
    })
  }, []);
  useEffect(() => {
    getTopNotes(5).then((res) => {
      setTopNotes(JSON.parse(res.data.res));
    })
  }, []);
  useEffect(() => {
    getLatestNotes(5).then((res) => {
      setLatestNotes(JSON.parse(res.data.res));
    })
  }, []);
  return (
    <MainLayout>
      <div className="TodayPage">
      <Header title="Today"/>
        <div className="container">
          <div className="card">
            <h2>Welcome {userHooks.user.firstName}!</h2>
            <p>Welcome to your daily dashboard. Here, you can view the latest updates from the AcaNotes community! We wish you a pleasant stay.</p>
          </div>
          <div className="card">
            <h2>Official Announcements</h2>
            {announcements.length &&
              <div>
                {announcements.map((row, i) => {
                  return (
                    <p key={i}>{row.announcement}</p>
                  )
                })}
              </div>
            }
          </div>
          <div className="card top-users">
            <h2 className="title">Prominent Users</h2>
            {topUsers.length &&
              <div className="users">
                {topUsers.map((row, i) => {
                  let i1 = randomColors();
                  let i2 = randomColors(i1);
                  let c = "linear-gradient(" + Math.random() + "turn, " + i1  + ", " + i2 + ")";
                  console.log(c);
                  return (
                    <div key={i} className="user-card">
                      <div className="stand-in-avatar" style={{background:c}}></div>
                      <div className="user-name">Name: {row.user_first}</div>
                      <div className="user-title">Title: {row.user_title}</div>
                      <div className="user-rating"><Rate disabled value={row.user_rating}/></div>
                      <div className="user-downloads">Downloads: {row.user_downloads}</div>
                    </div>
                  )
                })}
              </div>
            }
          </div>
          <div className="card top-notes notes-section">
          <h2 className="title">Popular Notes</h2>
          {topNotes.length &&
            <div className="notes">
              {topNotes.map((row, i) => {
                let i1 = randomColors();
                let i2 = randomColors(i1);
                let c = "linear-gradient(" + Math.random() + "turn, " + i1  + ", " + i2 + ")";
                console.log(c);
                return (
                  <div key={i} className="notes-card">
                    <div className="notes-title">Title: {row.a_title}</div>
                    <div className="notes-rating"><Rate disabled value={row.a_rating}/></div>
                    <div className="notes-author">Author: {row.a_author}</div>
                    <div className="notes-date">Date: {row.a_date}</div>
                    <div className="notes-desc">Description: {row.a_description}</div>
                    <div className="notes-downloads">Downloads: {row.a_downloads}</div>
                  </div>
                )
              })}
            </div>
          }
          </div>
          <div className="card top-notes notes-section">
            <h2 className="title">New Notes</h2>
            {latestNotes.length &&
              <div className="notes">
                {latestNotes.map((row, i) => {
                  let i1 = randomColors();
                  let i2 = randomColors(i1);
                  let c = "linear-gradient(" + Math.random() + "turn, " + i1  + ", " + i2 + ")";
                  console.log(c);
                  return (
                    <div key={i} className="notes-card">
                      <div className="notes-title">Title: {row.a_title}</div>
                      <div className="notes-rating"><Rate disabled value={row.a_rating}/></div>
                      <div className="notes-author">Author: {row.a_author}</div>
                      <div className="notes-date">Date: {row.a_date}</div>
                      <div className="notes-desc">Description: {row.a_description}</div>
                      <div className="nnotes-downloads">Downloads: {row.a_downloads}</div>
                    </div>
                  )
                })}
              </div>
            }
          </div>
        </div>
      </div>
    </MainLayout>
  )
}

export default TodayPage
