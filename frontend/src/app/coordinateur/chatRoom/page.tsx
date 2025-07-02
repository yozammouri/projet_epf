import { auth } from '@/auth';
import ChatBox from '../../../components/reusable/chatBox';
// import MercureSubscriber from '@/components/reusable/componentSubscriber';

export default async function page() {
  const session = await auth()
  // const token = session?.token;
  if (!session?.user.roles.includes("ROLE_COORDINATEUR")) {
    return (
      <div className='flex justify-center items-center h-screen'>
        <h1 className='font-bold text-red-600'>You're not authorized to access this resource!</h1>
      </div>
    )
  }
  return (
    <div className="max-w-2xl mx-auto p-4 h-[80vh] flex flex-col">
      <ChatBox session={session} receiverId={2} />
      {/* <MercureSubscriber session={session} receiverId={2} /> */}
    </div>
  );
}