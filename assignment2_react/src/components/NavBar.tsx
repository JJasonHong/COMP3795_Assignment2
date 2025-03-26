import { Link } from "react-router-dom";

type NavBarProps = {
  title: string;
};

const NavBar = ({ title }: NavBarProps) =>
{
  return (
    <header className="bg-white border-bottom sticky-top">
      <nav className="navbar navbar-expand-lg navbar-light container py-2">
        <div className="container-fluid">
          <Link className="navbar-brand fw-bold fs-4 text-primary" to="/">
            { title.split(' ')[ 0 ] }
            <span className="text-dark">{ title.split(' ').slice(1).join(' ') }</span>
          </Link>
          <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span className="navbar-toggler-icon"></span>
          </button>
          <div className="collapse navbar-collapse" id="navbarNav">
            <form className="d-flex mx-lg-4 flex-grow-1">
              <div className="input-group">
                <Link 
                  to="https://www.google.com" 
                  target="_blank" 
                  rel="noopener noreferrer" 
                  className="input-group-text bg-light border-end-0 text-decoration-none"
                >
                  <i className="bi bi-search"></i>
                </Link>
                <input className="form-control bg-light border-start-0" type="search" placeholder="Search..." />
              </div>
            </form>
            <ul className="navbar-nav me-auto mb-2 mb-lg-0 d-none d-lg-flex">
            <li className="nav-item">
              
                
              </li>
           
            </ul>

          </div>
        </div>
      </nav>
    </header>
  );
};

export default NavBar;