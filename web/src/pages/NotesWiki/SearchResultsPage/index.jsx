import React, { useEffect, useState } from 'react';
import { Button } from 'antd';
import MainLayout from 'layouts/MainLayout';
import Header from 'components/Header';
import NotesList from 'components/Notes/NotesList';

import { searchNotes } from 'actions/notes';

import './index.less';

const SearchResultsPage = (props) => {
  const [searchedNotes, setSearchedNotes] = useState(["empty"]);
  const [notesLoading, setLoading] = useState(true);

  useEffect(() => {
    let query = props.match ? props.match.params.query : props.query;
    searchNotes(query).then((res) => {
      setSearchedNotes(JSON.parse(res.data.res));
      setLoading(false);
    });
  }, []);
  return (
    <MainLayout>
      <div className="SearchResultsPage">
        <Header title="Search Notes"/>
        <div className="main-container">
          <h2>Search Result: </h2>
          <NotesList notes={searchedNotes} loading={notesLoading}/>
        </div>
      </div>
    </MainLayout>
  )
}

export default SearchResultsPage
