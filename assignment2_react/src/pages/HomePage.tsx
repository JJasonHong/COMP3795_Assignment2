import { ReactNode, useState, useEffect } from "react";
import axios from "axios";
import NavBar from "../components/NavBar";
import LeftSidebar from "../components/LeftSidebar";
import RightSidebar from "../components/RightSidebar";
import PostsList from "../components/PostsList";
import FeaturedPost from "../components/FeaturedPost";
import Footer from "../components/Footer";
import Config from "../config";

type HomePageProps = {
  title?: string;
  subtitle?: string;
  children?: ReactNode;
};

export type BlogPost = {
  ArticleId: number;
  Title: string;
  Body: string;
  CreatDate: string;
  StartDate: string;
  EndDate: string;
  ContributorUsername: string;
  created_at: string;
  updated_at: string;
  category?: string;
  readTime?: number;
  comments?: number;
  reactions?: number;
};

const HomePage = ({ title = "My Blog" }: HomePageProps) => {
  const [articles, setArticles] = useState<BlogPost[]>([]); // Added state to store articles

  // Fetch articles from Laravel API when component mounts
  useEffect(() => {
    axios.get(`${Config.API_BASE_URL}/articles`)
      .then(response => {
        setArticles(response.data.data || response.data); // Store fetched articles
      })
      .catch(error => console.error("Error fetching articles:", error));
  }, []);

  return (
    <div className="min-vh-100 d-flex flex-column bg-light">
      {/* NavBar */}
      <NavBar title={title} />

      <main className="container flex-grow-1 py-4">
        <div className="row g-4">
          {/* Left Sidebar */}
          <aside className="col-lg-3 d-none d-lg-block">
            <LeftSidebar />
          </aside>

          {/* Main Content */}
          <div className="col-lg-6">
            {/* Featured Post */}
            {articles.length > 0 && <FeaturedPost post={articles[0]} />}

            {/* Recent posts: articles latest 5 */}
            <PostsList posts={articles.slice(1, 5)} />
          </div>

          {/* Right Sidebar */}
          <aside className="col-lg-3 d-none d-lg-block">
            <RightSidebar />
          </aside>
        </div>
      </main>

      {/* Footer */}
      <Footer title={title} />

      {/* Bootstrap icons & custom styles */}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
      <style>
        {`
        .transition-hover {
          transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .transition-hover:hover {
          transform: translateY(-3px);
          box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }
        .nav-tabs .nav-link.active {
          border-bottom: 2px solid #0d6efd;
          background: transparent;
        }
        .nav-tabs .nav-link:hover:not(.active) {
          border-bottom: 2px solid #e9ecef;
        }
        `}
      </style>
    </div>
  );
};

export default HomePage;