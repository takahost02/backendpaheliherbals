@extends($activeTemplate.'layouts.master')

@push('style')
<style>
    /* Tree Container */
    .tree-view-container {
        position: relative;
        width: 100%;
        height: 700px;
        overflow: hidden;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    /* Current User Header */
    .tree-current-user {
        padding: 15px;
        background: white;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .current-user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 3px solid #667eea;
        object-fit: cover;
    }

    .current-user-info h5 {
        margin: 0;
        color: #333;
        font-weight: 600;
    }

    .current-user-info .badge {
        font-size: 12px;
        padding: 3px 10px;
    }

    /* Tree Controls */
    .tree-controls {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 100;
        display: flex;
        gap: 8px;
        background: white;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .tree-controls button {
        width: 40px;
        height: 40px;
        border-radius: 6px;
        border: 1px solid #ddd;
        background: white;
        color: #333;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .tree-controls button:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }

    .zoom-level {
        display: flex;
        align-items: center;
        padding: 0 12px;
        font-weight: 600;
        color: #333;
    }

    /* Tree Wrapper */
    .tree-wrapper {
        position: relative;
        width: 100%;
        height: calc(100% - 82px);
    }

    .tree-svg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }

    .tree-nodes-container {
        position: relative;
        width: 100%;
        height: 100%;
        transform-origin: center center;
        transition: transform 0.3s ease;
        z-index: 2;
    }

    /* Tree Node Styling */
    .tree-node {
        position: absolute;
        width: 160px;
        min-height: 90px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        padding: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
        border: 2px solid transparent;
    }

    .tree-node:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        border-color: #667eea;
    }

    .tree-node.active {
        border-color: #4CAF50;
        background: #f8fff9;
    }

    .tree-node.collapsed {
        background: #f8f9fa;
        opacity: 0.9;
    }

    .node-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 10px;
        display: block;
        border: 3px solid #e0e0e0;
    }

    .node-info {
        text-align: center;
    }

    .node-username {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 5px;
        font-size: 14px;
        word-break: break-all;
    }

    .node-status {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .node-status.active {
        background: #10b981;
        color: white;
    }

    .node-status.inactive {
        background: #ef4444;
        color: white;
    }

    .node-plan {
        font-size: 11px;
        color: #6b7280;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .node-team {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid #e5e7eb;
    }

    .team-left, .team-right {
        font-size: 11px;
        font-weight: 700;
    }

    .team-left { color: #3b82f6; }
    .team-right { color: #f59e0b; }

    /* Expand Button */
    .expand-btn {
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #667eea;
        color: white;
        border: 2px solid white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: bold;
        z-index: 15;
        transition: all 0.3s;
    }

    .expand-btn:hover {
        background: #5a67d8;
        transform: translateX(-50%) scale(1.1);
    }

    /* Placeholder Node */
    .node-placeholder {
        background: rgba(255,255,255,0.8);
        border: 2px dashed #94a3b8;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #64748b;
        cursor: pointer;
    }

    .node-placeholder:hover {
        background: rgba(255,255,255,0.9);
        border-color: #667eea;
    }

    .node-placeholder i {
        font-size: 24px;
        margin-bottom: 8px;
        color: #667eea;
    }

    /* Loading Overlay */
    .tree-loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
        display: none;
    }

    .tree-loading .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(102, 126, 234, 0.3);
        border-top: 4px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Breadcrumb */
    .tree-breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0 15px;
        flex-wrap: wrap;
    }

    .breadcrumb-item {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #64748b;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 6px;
        transition: all 0.3s;
    }

    .breadcrumb-item:hover {
        background: #f1f5f9;
        color: #334155;
    }

    .breadcrumb-item.active {
        color: #667eea;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .tree-view-container {
            height: 500px;
        }
        
        .tree-node {
            width: 140px;
            padding: 10px;
        }
        
        .node-avatar {
            width: 40px;
            height: 40px;
        }
    }
</style>
@endpush

@section('content')
<div class="card custom--card">
    <div class="card-header">
        <h5 class="card-title mb-0">@lang('Network Binary Tree')</h5>
    </div>
    <div class="card-body">
        <div class="tree-view-container">
            <!-- Current User Header -->
            <div class="tree-current-user">
                <div>
                    <img id="currentUserAvatar" src="" alt="" class="current-user-avatar">
                </div>
                <div class="current-user-info">
                    <h5 id="currentUserName">Loading...</h5>
                    <span class="badge bg-primary" id="currentUserPlan">Loading...</span>
                    <span class="badge bg-success" id="currentUserStatus">Loading...</span>
                </div>
                <div class="ms-auto tree-breadcrumb" id="treeBreadcrumb">
                    <!-- Breadcrumb will be populated by JS -->
                </div>
            </div>

            <!-- Tree Area -->
            <div class="tree-wrapper">
                <svg class="tree-svg" id="treeConnectors"></svg>
                <div class="tree-nodes-container" id="treeNodesContainer"></div>
                
                <!-- Controls -->
                <div class="tree-controls">
                    <button id="zoomIn" title="Zoom In">
                        <i class="fas fa-search-plus"></i>
                    </button>
                    <button id="zoomOut" title="Zoom Out">
                        <i class="fas fa-search-minus"></i>
                    </button>
                    <button id="resetView" title="Reset View">
                        <i class="fas fa-expand-alt"></i>
                    </button>
                    <div class="zoom-level">
                        <span id="zoomLevel">100%</span>
                    </div>
                </div>
                
                <!-- Loading -->
                <div class="tree-loading" id="treeLoading">
                    <div class="spinner"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Details Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('User Details')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userDetailsContent">
                <!-- Content will be loaded via AJAX -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
class NetworkBinaryTree {
    constructor() {
        this.container = document.getElementById('treeNodesContainer');
        this.connectors = document.getElementById('treeConnectors');
        this.loadingEl = document.getElementById('treeLoading');
        this.treeData = null;
        this.zoomLevel = 1;
        this.offset = { x: 0, y: 0 };
        this.isDragging = false;
        this.dragStart = { x: 0, y: 0 };
        this.nodeHistory = [];
        this.currentUser = @json($user);
        
        this.init();
    }
    
    init() {
        this.showLoading();
        
        // Load tree data for current user
        this.loadTreeData(this.currentUser.id);
        
        // Setup event listeners
        this.setupControls();
        this.setupPanZoom();
    }
    
    showLoading() {
        this.loadingEl.style.display = 'block';
    }
    
    hideLoading() {
        this.loadingEl.style.display = 'none';
    }
    
    async loadTreeData(userId, addToHistory = true) {
        this.showLoading();
        
        try {
            const response = await fetch(`{{ route('user.tree.data') }}?user_id=${userId}`);
            const data = await response.json();
            
            if (data.success) {
                this.treeData = data.treeData;
                
                // Update current user info
                this.updateCurrentUserInfo(data.user);
                
                // Add to history
                if (addToHistory && this.nodeHistory[this.nodeHistory.length - 1]?.id !== userId) {
                    this.nodeHistory.push({
                        id: userId,
                        username: data.user.username,
                        fullname: data.user.fullname
                    });
                }
                
                // Update breadcrumb
                this.updateBreadcrumb();
                
                // Render tree
                this.renderTree();
                
                // Update URL if not current user
                if (userId !== {{ auth()->id() }}) {
                    history.pushState({ userId }, '', `{{ route('user.tree.show', '') }}/${data.user.username}`);
                }
            }
        } catch (error) {
            console.error('Error loading tree:', error);
            this.showError('Failed to load tree data');
        } finally {
            this.hideLoading();
        }
    }
    
    updateCurrentUserInfo(user) {
        document.getElementById('currentUserAvatar').src = user.image;
        document.getElementById('currentUserName').textContent = `${user.fullname} (${user.username})`;
        document.getElementById('currentUserPlan').textContent = user.plan_name;
        document.getElementById('currentUserStatus').textContent = user.status;
        document.getElementById('currentUserStatus').className = `badge bg-${user.status === 'Active' ? 'success' : 'danger'}`;
    }
    
    updateBreadcrumb() {
        const breadcrumbEl = document.getElementById('treeBreadcrumb');
        breadcrumbEl.innerHTML = '';
        
        this.nodeHistory.forEach((node, index) => {
            const item = document.createElement('div');
            item.className = `breadcrumb-item ${index === this.nodeHistory.length - 1 ? 'active' : ''}`;
            
            if (index < this.nodeHistory.length - 1) {
                item.innerHTML = `
                    <span>${node.username}</span>
                    <i class="fas fa-chevron-right text-muted" style="font-size: 10px;"></i>
                `;
                item.addEventListener('click', () => this.navigateToNode(node.id, index));
            } else {
                item.innerHTML = `<span>${node.username}</span>`;
            }
            
            breadcrumbEl.appendChild(item);
        });
    }
    
    navigateToNode(userId, index) {
        // Truncate history
        this.nodeHistory = this.nodeHistory.slice(0, index + 1);
        this.loadTreeData(userId, false);
    }
    
    renderTree() {
        // Clear container
        this.container.innerHTML = '';
        this.connectors.innerHTML = '';
        
        if (!this.treeData) return;
        
        // Calculate positions
        const rootPosition = {
            x: this.container.clientWidth / 2,
            y: 80
        };
        
        // Render root node
        this.renderNode(this.treeData, rootPosition, 'root');
        
        // Render children if expanded
        if (this.treeData.expanded !== false) {
            this.renderChildren(this.treeData, rootPosition, 1);
        }
        
        // Draw connectors after a small delay to ensure nodes are rendered
        setTimeout(() => this.drawConnectors(), 100);
    }
    
    renderNode(node, position, type = 'node') {
        const nodeEl = document.createElement('div');
        nodeEl.className = `tree-node ${type === 'root' ? 'active' : ''} ${node.expanded === false ? 'collapsed' : ''}`;
        nodeEl.style.left = `${position.x - 80}px`;
        nodeEl.style.top = `${position.y}px`;
        nodeEl.dataset.userId = node.id;
        nodeEl.dataset.type = type;
        
        // Build node HTML
        let teamHtml = '';
        if (node.left_count > 0 || node.right_count > 0) {
            teamHtml = `
                <div class="node-team">
                    <div class="team-left">L: ${node.left_count || 0}</div>
                    <div class="team-right">R: ${node.right_count || 0}</div>
                </div>
            `;
        }
        
        nodeEl.innerHTML = `
            <img src="${node.image}" alt="${node.username}" class="node-avatar"
                 onerror="this.src='{{ asset('assets/images/default.png') }}'">
            <div class="node-info">
                <div class="node-username" title="${node.fullname}">${node.username}</div>
                <div class="node-status ${node.status.toLowerCase()}">${node.status}</div>
                <div class="node-plan">${node.plan}</div>
                ${teamHtml}
            </div>
            ${(node.has_left || node.has_right) ? `
                <button class="expand-btn" data-action="toggle">
                    ${node.expanded === false ? '+' : '-'}
                </button>
            ` : ''}
        `;
        
        // Add event listeners
        nodeEl.addEventListener('click', (e) => {
            if (e.target.closest('.expand-btn')) {
                e.stopPropagation();
                this.toggleNode(node.id);
            } else {
                this.showUserDetails(node.id);
            }
        });
        
        this.container.appendChild(nodeEl);
    }
    
    renderChildren(parentNode, parentPosition, level) {
        const horizontalSpacing = 200 * Math.pow(0.8, level - 1);
        const verticalSpacing = 100;
        
        // Left child
        if (parentNode.left) {
            const leftPos = {
                x: parentPosition.x - horizontalSpacing,
                y: parentPosition.y + verticalSpacing
            };
            this.renderNode(parentNode.left, leftPos);
            
            // Render grandchildren if expanded
            if (parentNode.left.expanded !== false) {
                this.renderChildren(parentNode.left, leftPos, level + 1);
            }
        } else if (parentNode.has_left) {
            // Show placeholder for unloaded left child
            this.renderPlaceholder(parentNode.id, 'left', {
                x: parentPosition.x - horizontalSpacing,
                y: parentPosition.y + verticalSpacing
            });
        }
        
        // Right child
        if (parentNode.right) {
            const rightPos = {
                x: parentPosition.x + horizontalSpacing,
                y: parentPosition.y + verticalSpacing
            };
            this.renderNode(parentNode.right, rightPos);
            
            // Render grandchildren if expanded
            if (parentNode.right.expanded !== false) {
                this.renderChildren(parentNode.right, rightPos, level + 1);
            }
        } else if (parentNode.has_right) {
            // Show placeholder for unloaded right child
            this.renderPlaceholder(parentNode.id, 'right', {
                x: parentPosition.x + horizontalSpacing,
                y: parentPosition.y + verticalSpacing
            });
        }
    }
    
    renderPlaceholder(parentId, side, position) {
        const placeholderEl = document.createElement('div');
        placeholderEl.className = 'tree-node node-placeholder';
        placeholderEl.style.left = `${position.x - 80}px`;
        placeholderEl.style.top = `${position.y}px`;
        placeholderEl.dataset.parentId = parentId;
        placeholderEl.dataset.side = side;
        
        placeholderEl.innerHTML = `
            <i class="fas fa-user-plus"></i>
            <div style="font-size: 12px; text-align: center;">
                Load ${side}<br>Team
            </div>
        `;
        
        placeholderEl.addEventListener('click', (e) => {
            e.stopPropagation();
            this.loadChildren(parentId, side);
        });
        
        this.container.appendChild(placeholderEl);
    }
    
    drawConnectors() {
        const nodes = document.querySelectorAll('.tree-node:not(.node-placeholder)');
        
        nodes.forEach(parentNode => {
            const parentId = parentNode.dataset.userId;
            const parentRect = parentNode.getBoundingClientRect();
            const containerRect = this.container.getBoundingClientRect();
            
            const parentBottom = {
                x: parentRect.left + parentRect.width / 2 - containerRect.left,
                y: parentRect.top + parentRect.height - containerRect.top
            };
            
            // Find child nodes (not placeholders)
            const childNodes = Array.from(nodes).filter(node => {
                const parentDiv = node.parentNode.querySelector(`[data-user-id="${parentId}"]`);
                return parentDiv && node !== parentDiv && 
                       Math.abs(parentRect.top - node.getBoundingClientRect().top) > 50;
            });
            
            childNodes.forEach(childNode => {
                const childRect = childNode.getBoundingClientRect();
                const childTop = {
                    x: childRect.left + childRect.width / 2 - containerRect.left,
                    y: childRect.top - containerRect.top
                };
                
                // Only draw if child is below parent
                if (childTop.y > parentBottom.y) {
                    const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                    line.setAttribute('x1', parentBottom.x);
                    line.setAttribute('y1', parentBottom.y);
                    line.setAttribute('x2', childTop.x);
                    line.setAttribute('y2', childTop.y);
                    line.setAttribute('stroke', '#94a3b8');
                    line.setAttribute('stroke-width', '2');
                    line.setAttribute('stroke-linecap', 'round');
                    
                    this.connectors.appendChild(line);
                }
            });
        });
    }
    
    toggleNode(nodeId) {
        const node = this.findNode(this.treeData, nodeId);
        if (node) {
            node.expanded = !node.expanded;
            this.renderTree();
        }
    }
    
    async loadChildren(parentId, side) {
        this.showLoading();
        
        try {
            const response = await fetch(`{{ route('user.tree.children') }}?parent_id=${parentId}&side=${side}`);
            const data = await response.json();
            
            if (data.success) {
                const parent = this.findNode(this.treeData, parentId);
                if (parent) {
                    if (side === 'left') {
                        parent.left = data.child;
                    } else {
                        parent.right = data.child;
                    }
                    parent.expanded = true;
                    this.renderTree();
                }
            }
        } catch (error) {
            console.error('Error loading children:', error);
            this.showError('Failed to load team members');
        } finally {
            this.hideLoading();
        }
    }
    
    async showUserDetails(userId) {
        this.showLoading();
        
        try {
            const response = await fetch(`{{ route('user.tree.details') }}?user_id=${userId}`);
            const data = await response.json();
            
            if (data.success) {
                document.getElementById('userDetailsContent').innerHTML = data.html;
                const modal = new bootstrap.Modal(document.getElementById('userDetailsModal'));
                modal.show();
                
                // Add click handler for "View Tree" button
                setTimeout(() => {
                    const viewTreeBtn = document.querySelector('.view-tree-btn');
                    if (viewTreeBtn) {
                        viewTreeBtn.addEventListener('click', () => {
                            this.loadTreeData(userId);
                            modal.hide();
                        });
                    }
                }, 100);
            }
        } catch (error) {
            console.error('Error loading user details:', error);
            this.showError('Failed to load user details');
        } finally {
            this.hideLoading();
        }
    }
    
    findNode(currentNode, nodeId) {
        if (!currentNode) return null;
        if (currentNode.id == nodeId) return currentNode;
        
        let found = null;
        if (currentNode.left) {
            found = this.findNode(currentNode.left, nodeId);
            if (found) return found;
        }
        
        if (currentNode.right) {
            found = this.findNode(currentNode.right, nodeId);
            if (found) return found;
        }
        
        return null;
    }
    
    setupControls() {
        // Zoom controls
        document.getElementById('zoomIn').addEventListener('click', () => this.zoom(1.2));
        document.getElementById('zoomOut').addEventListener('click', () => this.zoom(0.8));
        document.getElementById('resetView').addEventListener('click', () => this.resetView());
        
        // Handle browser back/forward
        window.addEventListener('popstate', (event) => {
            if (event.state && event.state.userId) {
                this.loadTreeData(event.state.userId, false);
            }
        });
    }
    
    setupPanZoom() {
        // Mouse wheel zoom
        this.container.addEventListener('wheel', (e) => {
            if (e.ctrlKey || e.metaKey) {
                e.preventDefault();
                const delta = e.deltaY > 0 ? 0.9 : 1.1;
                this.zoom(delta, e.clientX, e.clientY);
            }
        });
        
        // Pan with mouse drag
        this.container.addEventListener('mousedown', (e) => {
            if (e.target.closest('.tree-node') || e.target.closest('.tree-controls')) {
                return;
            }
            
            this.isDragging = true;
            this.dragStart = {
                x: e.clientX - this.offset.x,
                y: e.clientY - this.offset.y
            };
            this.container.style.cursor = 'grabbing';
        });
        
        document.addEventListener('mousemove', (e) => {
            if (!this.isDragging) return;
            
            e.preventDefault();
            this.offset.x = e.clientX - this.dragStart.x;
            this.offset.y = e.clientY - this.dragStart.y;
            this.updateTransform();
        });
        
        document.addEventListener('mouseup', () => {
            this.isDragging = false;
            this.container.style.cursor = 'grab';
        });
    }
    
    zoom(scale, centerX = null, centerY = null) {
        const oldZoom = this.zoomLevel;
        this.zoomLevel *= scale;
        this.zoomLevel = Math.max(0.1, Math.min(5, this.zoomLevel));
        
        if (centerX && centerY) {
            const rect = this.container.getBoundingClientRect();
            const relativeX = centerX - rect.left;
            const relativeY = centerY - rect.top;
            
            this.offset.x = relativeX - (relativeX - this.offset.x) * (this.zoomLevel / oldZoom);
            this.offset.y = relativeY - (relativeY - this.offset.y) * (this.zoomLevel / oldZoom);
        }
        
        this.updateTransform();
        document.getElementById('zoomLevel').textContent = `${Math.round(this.zoomLevel * 100)}%`;
    }
    
    resetView() {
        this.zoomLevel = 1;
        this.offset = { x: 0, y: 0 };
        this.updateTransform();
        document.getElementById('zoomLevel').textContent = '100%';
    }
    
    updateTransform() {
        this.container.style.transform = `
            translate(${this.offset.x}px, ${this.offset.y}px)
            scale(${this.zoomLevel})
        `;
    }
    
    showError(message) {
        alert(message);
    }
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', () => {
    window.networkTree = new NetworkBinaryTree();
});
</script>
@endpush

@push('breadcrumb-plugins')
<div class="input-group has_append">
    <input type="text" id="treeSearch" class="form-control form--control" 
           placeholder="@lang('Search by username')" value="{{ $user->username ?? '' }}">
    <button class="btn btn--success" id="searchTreeBtn">
        <i class="fa fa-search"></i>
    </button>
</div>

<script>
document.getElementById('searchTreeBtn').addEventListener('click', function() {
    const username = document.getElementById('treeSearch').value.trim();
    if (username) {
        window.location.href = `{{ route('user.tree.show', '') }}/${username}`;
    }
});

document.getElementById('treeSearch').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        const username = this.value.trim();
        if (username) {
            window.location.href = `{{ route('user.tree.show', '') }}/${username}`;
        }
    }
});
</script>
@endpush