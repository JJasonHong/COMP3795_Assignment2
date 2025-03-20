import { Link } from "react-router-dom";

type FooterProps = {
  title: string;
};

const Footer = ({ title }: FooterProps) => {
  return (
    <footer className="bg-white border-top mt-auto py-4">
      <div className="container">
        <div className="row">
          <div className="col-lg-4 mb-4 mb-lg-0">
            <Link className="text-decoration-none" to="/">
              <h4 className="fw-bold text-primary mb-3">
                {title.split(' ')[0]}
                <span className="text-dark"> {title.split(' ').slice(1).join(' ')}</span>
              </h4>
            </Link>
            <p className="text-muted">
              A constructive and inclusive social network for software developers.
            </p>
          </div>
          <div className="col-6 col-lg-2">
            <h6 className="fw-bold mb-3">Navigation</h6>
            <ul className="list-unstyled mb-0">
              <li className="mb-2">
                <Link to="/" className="text-decoration-none text-secondary">Home</Link>
              </li>
              <li className="mb-2">
                <Link to="https://podcasts.apple.com/us/browse" className="text-decoration-none text-secondary">Podcasts</Link>
              </li>
              <li className="mb-2">
                <Link to="https://www.youtube.com/" className="text-decoration-none text-secondary">Videos</Link>
              </li>
              <li className="mb-2">
                <Link to="https://rapidtags.io/generator" className="text-decoration-none text-secondary">Tags</Link>
              </li>
            </ul>
          </div>
          {/* <div className="col-6 col-lg-2">
            <h6 className="fw-bold mb-3">Resources</h6>
            <ul className="list-unstyled mb-0">
              <li className="mb-2">
                <Link to="/about" className="text-decoration-none text-secondary">About</Link>
              </li>
              <li className="mb-2">
                <Link to="/contact" className="text-decoration-none text-secondary">Contact</Link>
              </li>
              <li className="mb-2">
                <Link to="/guides" className="text-decoration-none text-secondary">Guides</Link>
              </li>
              <li className="mb-2">
                <Link to="/faq" className="text-decoration-none text-secondary">FAQ</Link>
              </li>
            </ul>
          </div> */}
          <div className="col-lg-4 mt-4 mt-lg-0">
            <h6 className="fw-bold mb-3">Connect with us</h6>
            <div className="d-flex gap-3 mb-3">
              <Link to="https://x.com/?lang=en-ca" className="btn btn-outline-secondary rounded-circle">
                <i className="bi bi-twitter"></i>
              </Link>
              <Link to="https://www.facebook.com/" className="btn btn-outline-secondary rounded-circle">
                <i className="bi bi-facebook"></i>
              </Link>
              <Link to="https://github.com/" className="btn btn-outline-secondary rounded-circle">
                <i className="bi bi-github"></i>
              </Link>
              <Link to="https://www.instagram.com/" className="btn btn-outline-secondary rounded-circle">
                <i className="bi bi-instagram"></i>
              </Link>
            </div>
          </div>
        </div>
        <div className="border-top mt-4 pt-4 text-center">
          <p className="text-muted small mb-0">
          Created by:
                    <strong>Team Members: </strong>
                    Gem Sha A01345766,
                    Brian Diep A00959233,
                    Jason Hong A01232139
                    </p>
          <p className="text-muted small mb-0">
            © {new Date().getFullYear()} {title}. All rights reserved.
          </p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;