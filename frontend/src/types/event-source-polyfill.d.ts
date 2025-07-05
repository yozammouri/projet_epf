declare module 'event-source-polyfill' {
  export class EventSourcePolyfill {
    constructor(url: string, eventSourceInitDict?: EventSourceInit & { headers?: Record<string, string> });
    close(): void;
    onopen: ((this: EventSource, ev: Event) => any) | null;
    onmessage: ((this: EventSource, ev: MessageEvent) => any) | null;
    onerror: ((this: EventSource, ev: Event) => any) | null;
    readyState: number;
  }
}
