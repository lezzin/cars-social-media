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
    image: string | null;
    user: User
    created_at: string;
    likes_count: number;
    comments_count: number;
    liked_by_user?: boolean;
}

export interface Comment {
    id: number;
    content: string;
    created_at: string;
    user: User;
    replies?: Comment[];
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

export type PostReaction = 'COMMENT' | 'LIKE'; 