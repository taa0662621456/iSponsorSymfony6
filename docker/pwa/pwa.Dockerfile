FROM node:18-alpine as builder_base

RUN apk update && \
    apk add --no-cache libc6-compat git && \
    rm -rf /var/cache/apk/*


WORKDIR /srv/app

RUN corepack enable && \
	corepack prepare --activate pnpm@latest && \
    pnpm config set store-dir /.pnpm-store

ENV NEXT_TELEMETRY_DISABLED 1


FROM builder_base AS deps

RUN pnpm fetch

COPY . .
RUN pnpm install


# Development image
FROM deps as dev

EXPOSE 3000
ENV PORT 3000

CMD ["sh", "-c", "pnpm install -r; pnpm dev"]


FROM builder_base AS builder
COPY . .
COPY --from=deps  /srv/app/node_modules ./node_modules

RUN pnpm run build


# Production image, copy all the files and run next
FROM node:18-alpine AS prod
WORKDIR /srv/app

ENV NODE_ENV production
# Uncomment the following line in case you want to disable telemetry during runtime.
ENV NEXT_TELEMETRY_DISABLED 1

RUN addgroup --system --gid 1001 nodejs
RUN adduser --system --uid 1001 nextjs

COPY --from=builder  /srv/app/public ./public

COPY --from=builder  --chown=nextjs:nodejs /srv/app/.next/standalone ./
COPY --from=builder  --chown=nextjs:nodejs /srv/app/.next/static ./.next/static

USER nextjs

EXPOSE 3000

ENV PORT 3000

CMD ["node", "server.js"]
