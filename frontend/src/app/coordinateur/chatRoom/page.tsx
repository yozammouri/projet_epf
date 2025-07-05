import { auth } from '@/auth';
import ChatBox from '../../../components/reusable/chatBox';
import ChatWrapper from '@/components/reusable/chatWrapper';
// import MercureSubscriber from '@/components/reusable/componentSubscriber';

export default async function page() {
  const session = await auth()
  if (!session?.user.roles.includes("ROLE_COORDINATEUR")) {
    return (
      <div className='flex justify-center items-center h-screen'>
        <h1 className='font-bold text-red-600'>You're not authorized to access this resource!</h1>
      </div>
    )
  }
  const token = session.token;
  return (
    <div className="p-4 flex w-full items-center font-bold">
      {/* <ChatBox session={session} receiverId={2} /> */}
      <ChatWrapper session={session} token={token} />
      {/* HELLO THIS IS THE CHAT ROOM */}
    </div>
  );
}