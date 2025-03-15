import React from "react";

type FilterType = 'relevant' | 'latest' | 'top';

type FilterTabsProps = {
  activeFilter: FilterType;
  setActiveFilter: React.Dispatch<React.SetStateAction<FilterType>>;
};

const FilterTabs = ({ activeFilter, setActiveFilter }: FilterTabsProps) => {
  return (
    <div className="d-flex justify-content-start mb-4 border-bottom">
      <div className="nav nav-tabs border-0">
        <button
          className={`nav-link border-0 px-3 py-2 ${activeFilter === 'relevant' ? 'fw-bold text-primary active' : 'text-secondary'}`}
          onClick={() => setActiveFilter('relevant')}
        >
          Relevant
        </button>
        <button
          className={`nav-link border-0 px-3 py-2 ${activeFilter === 'latest' ? 'fw-bold text-primary active' : 'text-secondary'}`}
          onClick={() => setActiveFilter('latest')}
        >
          Latest
        </button>
        <button
          className={`nav-link border-0 px-3 py-2 ${activeFilter === 'top' ? 'fw-bold text-primary active' : 'text-secondary'}`}
          onClick={() => setActiveFilter('top')}
        >
          Top
        </button>
      </div>
    </div>
  );
};

export default FilterTabs;