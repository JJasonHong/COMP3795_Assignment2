import AboutPage from '../pages/AboutPage';
import { createBrowserRouter } from "react-router-dom";
import HomePage from "../pages/HomePage";
import App from "../App";
import NotFoundPage from "../components/NotFoundPage";
import BlogPostPage from "../pages/BlogPostPage"; // You'll need to create this component

/**
* The router configuration for the application.
*/
export const router = createBrowserRouter([
  {
    path: "/",
    element: <App />,
    children: [
      {
        path: "/",
        element: (
          <HomePage
            title="My Blog"
            subtitle="Thoughts, stories and ideas"
          />
        ),
      },
      {
        path: "/about",
        element: <AboutPage message={"About our blog and authors."} />,
      },
      {
        path: "/post/:id",
        element: <BlogPostPage />,
      },
      {
        path: "*",
        element: <NotFoundPage />,
      },
    ],
  },
]);