<?php 
 public function home(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $basePath  = $this->detectBasePath($request);
        $queryMode = $this->useQueryRouting($request);

        $modules    = [];
        $categories = [];

        foreach ($this->contentRepository->allModules() as $slug => $module) {
            $catKey = (string)($module['category'] ?? 'general');
            
            $moduleData = [
                'slug'    => $slug,
                'title'   => $module['title'] ?? $slug,
                'summary' => $module['summary'] ?? '',
                'tag'     => $module['tag'] ?? 'Documentación',
                'path'    => $this->routePath($basePath, '/' . $catKey . '/' . $slug, $queryMode),
            ];

            $modules[] = $moduleData;




    public function home(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $basePath  = $this->detectBasePath($request);
        $queryMode = $this->useQueryRouting($request);

        $modules    = [];
        $categories = [];

        foreach ($this->contentRepository->allModules() as $slug => $module) {
            $catKey = (string)($module['category'] ?? 'general');
            
            $moduleData = [
                'slug'    => $slug,
                'title'   => $module['title'] ?? $slug,
                'summary' => $module['summary'] ?? '',
                'tag'     => $module['tag'] ?? 'Documentación',
                'path'    => $this->routePath($basePath, '/' . $catKey . '/' . $slug, $queryMode),
            ];

            $modules[] = $moduleData;