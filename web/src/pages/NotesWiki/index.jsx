import React, { useEffect, useState } from 'react';
import { Button, Input } from 'antd';
import MainLayout from 'layouts/MainLayout';
import Header from 'components/Header';
import NotesList from 'components/Notes/NotesList';

import { getTopNotes } from 'actions/notes';
import { useHistory } from "react-router-dom";
import './index.less';

const NotesWikiPage = () => {
  const [topNotes, setTopNotes] = useState(["empty"]);
  const [topNotesLoading, setLoading] = useState(true);
  const history = useHistory();

  useEffect(() => {
    getTopNotes(5).then((res) => {
      setTopNotes(JSON.parse(res.data.res));
      setLoading(false);
    })
  }, []);
  return (
    <MainLayout>
      <div className="NotesWikiPage">
        <Header title="Notes Wiki"/>
        <div className="main-container">
          <Input.Search enterButton="Search" size="large" onSearch={(val) => {
            history.push("notes-wiki/search/" + val);
          }}/>
          <h2>Trending Notes</h2>
          <NotesList notes={topNotes} loading={topNotesLoading}/>
        </div>
      </div>
    </MainLayout>
  )
}

export default NotesWikiPage
