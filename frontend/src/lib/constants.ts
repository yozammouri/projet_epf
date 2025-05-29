export const BASE_URL =
  typeof window === 'undefined'
    ? 'http://backend'
    : process.env.NEXT_PUBLIC_API_URL!;