import React, { useEffect, useState } from 'react';
import { Button, Rate, Skeleton } from 'antd';
import MainLayout from 'layouts/MainLayout';
import Header from 'components/Header';
import Card from 'components/Card';
import UserContext from 'UserContext';

import UserList from 'components/User/UserList';
import NotesList from 'components/Notes/NotesList';

import { getAnnouncements } from 'actions/announcements';
import { getTop } from 'actions/users';
import { getTopNotes, getLatestNotes } from 'actions/notes';

import './index.less';

const TodayPage = () => {
  const [announcements, setAnnouncements] = useState([]);
  const [topUsers, setTopUsers] = useState([]);
  const [topNotes, setTopNotes] = useState([]);
  const [latestNotes, setLatestNotes] = useState([]);

  const [n1, setLoading1] = useState(true);
  const [n2, setLoading2] = useState(true);
  const [n3, setLoading3] = useState(true);

  const userHooks = React.useContext(UserContext);
  useEffect(() => {
    getAnnouncements(3).then((res) => {
      setAnnouncements(JSON.parse(res.data.res));
    });

  }, [])
  useEffect(() => {
    getTop(5).then((res) => {
      setTopUsers(JSON.parse(res.data.res));
      setLoading1(false);
    })
  }, []);
  useEffect(() => {
    getTopNotes(5).then((res) => {
      setTopNotes(JSON.parse(res.data.res));
      setLoading2(false);
    })
  }, []);
  useEffect(() => {
    getLatestNotes(5).then((res) => {
      setLatestNotes(JSON.parse(res.data.res));
      setLoading3(false);
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
            {announcements.length ?
              <div>
                {announcements.map((row, i) => {
                  return (
                    <p key={i}>{row.announcement}</p>
                  )
                })}
              </div> :
              <Skeleton active />
            }
          </div>
          <Card>
            <h2 className="title">Prominent Users</h2>
            <UserList users={topUsers} loading={n1} />
          </Card>
          <Card>
          <h2 className="title">Popular Notes</h2>
            <NotesList notes={topNotes} loading={n2} />
          </Card>
          <Card>
            <h2 className="title">Latest Notes</h2>
            <NotesList notes={latestNotes} loading={n3} />
          </Card>
        </div>
      </div>
    </MainLayout>
  )
}

export default TodayPage
