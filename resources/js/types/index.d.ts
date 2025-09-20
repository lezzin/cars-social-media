export interface User {
    id: number;
    name: string;
    username: string;
    email: string;
    email_verified_at?: string;
    image: string;
}

export interface Post {
    id: number;
    description: string;
    image_url: string | null;
    user: User
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};

export interface DashboardPageProps extends PageProps {
    posts: Post[];
    auth: {
        user: User;
    };
}