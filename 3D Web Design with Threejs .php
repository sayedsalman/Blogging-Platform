<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduction to 3D Web Design with Three.js | Sayed Salman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #00f7ff;
            --secondary: #7700ff;
            --dark: #0a0a1a;
            --light: #ffffff;
            --gray: #a3a3c2;
        }

        body {
            background-color: var(--dark);
            color: var(--light);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header & Navigation */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            transition: background 0.3s ease;
            background: rgba(10, 10, 26, 0.9);
            backdrop-filter: blur(10px);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 10px;
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 30px;
        }

        .nav-links a {
            color: var(--light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Blog Hero Section */
        .blog-hero {
            height: 60vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            margin-top: 80px;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .blog-hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            text-align: center;
            margin: 0 auto;
        }

        .blog-hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1.2;
        }

        .blog-meta {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
            color: var(--gray);
        }

        .blog-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Blog Content */
        .blog-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 50px 0;
        }

        .blog-content p {
            margin-bottom: 20px;
            font-size: 1.1rem;
            color: var(--light);
        }

        .blog-content h2 {
            font-size: 2rem;
            margin: 40px 0 20px;
            color: var(--primary);
        }

        .blog-content h3 {
            font-size: 1.5rem;
            margin: 30px 0 15px;
            color: var(--secondary);
        }

        .blog-content ul, .blog-content ol {
            margin: 20px 0;
            padding-left: 20px;
        }

        .blog-content li {
            margin-bottom: 10px;
        }

        .blog-image {
            width: 100%;
            border-radius: 10px;
            margin: 30px 0;
            box-shadow: 0 10px 30px rgba(0, 247, 255, 0.2);
        }

        .quote {
            border-left: 4px solid var(--primary);
            padding-left: 20px;
            margin: 30px 0;
            font-style: italic;
            color: var(--gray);
        }

        .code-block {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
            overflow-x: auto;
            font-family: monospace;
            position: relative;
        }

        .code-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .copy-btn {
            background: rgba(0, 247, 255, 0.1);
            border: 1px solid var(--primary);
            color: var(--primary);
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .copy-btn:hover {
            background: var(--primary);
            color: var(--dark);
        }

        /* Demo Container */
        .demo-container {
            background: rgba(255, 255, 255, 0.05);
            padding: 25px;
            border-radius: 15px;
            margin: 30px 0;
            border-left: 4px solid var(--secondary);
        }

        .demo-container h3 {
            color: var(--primary);
            margin-bottom: 15px;
        }

        #three-demo {
            width: 100%;
            height: 300px;
            border-radius: 10px;
            margin: 15px 0;
            background: rgba(0, 0, 0, 0.2);
        }

        .demo-controls {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .demo-btn {
            padding: 8px 15px;
            background: rgba(0, 247, 255, 0.1);
            border: 1px solid var(--primary);
            color: var(--primary);
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .demo-btn:hover {
            background: var(--primary);
            color: var(--dark);
        }

        /* Related Posts */
        .related-posts {
            padding: 50px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .related-post {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .related-post:hover {
            transform: translateY(-10px);
        }

        .related-img {
            height: 200px;
            overflow: hidden;
        }

        .related-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .related-post:hover .related-img img {
            transform: scale(1.1);
        }

        .related-info {
            padding: 20px;
        }

        .related-info h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: var(--primary);
        }

        /* 3D Animation Canvas */
        #three-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        /* Footer */
        footer {
            background: rgba(0, 0, 0, 0.2);
            padding: 40px 0;
            text-align: center;
            margin-top: 50px;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: var(--light);
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-links a:hover {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            transform: translateY(-5px);
        }

        /* Back to Portfolio Button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            margin-top: 30px;
            padding: 10px 20px;
            border: 1px solid var(--primary);
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            gap: 15px;
            background: rgba(0, 247, 255, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .blog-hero h1 {
                font-size: 2.5rem;
            }
            
            .nav-links {
                display: none;
            }
            
            .blog-meta {
                flex-direction: column;
                gap: 10px;
            }
            
            .related-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- 3D Background Canvas -->
    <div id="three-canvas"></div>
    
    <!-- Particles Background -->
    <div id="particles-js"></div>
    
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <i class="fas fa-atom"></i> SAYED SALMAN
                </div>
                <ul class="nav-links">
                    <li><a href="index.html#home">Home</a></li>
                    <li><a href="index.html#about">About</a></li>
                    <li><a href="index.html#blog">Blog</a></li>
                    <li><a href="index.html#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Blog Hero Section -->
    <section class="blog-hero">
        <div class="container">
            <div class="blog-hero-content">
                <h1>Introduction to 3D Web Design with Three.js</h1>
                <div class="blog-meta">
                    <span><i class="far fa-calendar"></i> March 12, 2023</span>
                    <span><i class="far fa-clock"></i> 10 min read</span>
                    <span><i class="far fa-folder"></i> Web Development</span>
                </div>
                <p>A beginner's guide to creating stunning 3D visuals for the web using Three.js library.</p>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="blog-content">
        <div class="container">
            <p>The web has evolved from simple text pages to rich, interactive experiences. One of the most exciting developments in recent years is the ability to create 3D graphics directly in the browser. Three.js is a powerful JavaScript library that makes 3D web design accessible to developers.</p>
            
            <h2>What is Three.js?</h2>
            <p>Three.js is a cross-browser JavaScript library and API used to create and display animated 3D computer graphics in a web browser. It acts as a wrapper around WebGL, making it much easier to work with 3D graphics without needing to write complex WebGL code.</p>
            
            <img src="https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Three.js 3D Graphics" class="blog-image">
            
            <h2>Core Concepts of Three.js</h2>
            <p>To work with Three.js, you need to understand a few fundamental concepts:</p>
            
            <div class="demo-container">
                <h3>1. Scene</h3>
                <p>The scene is the container that holds all your 3D objects, lights, and cameras. It's like a stage where everything happens.</p>
                <div class="code-block">
                    <div class="code-header">
                        <span>JavaScript</span>
                        <button class="copy-btn" onclick="copyCode(this)">Copy Code</button>
                    </div>
                    <pre><code>const scene = new THREE.Scene();</code></pre>
                </div>
            </div>
            
            <div class="demo-container">
                <h3>2. Camera</h3>
                <p>The camera defines what part of the scene is visible. The most common is the PerspectiveCamera, which mimics how the human eye sees.</p>
                <div class="code-block">
                    <div class="code-header">
                        <span>JavaScript</span>
                        <button class="copy-btn" onclick="copyCode(this)">Copy Code</button>
                    </div>
                    <pre><code>const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
camera.position.z = 5;</code></pre>
                </div>
            </div>
            
            <div class="demo-container">
                <h3>3. Renderer</h3>
                <p>The renderer draws the scene from the camera's perspective onto a canvas element in your HTML document.</p>
                <div class="code-block">
                    <div class="code-header">
                        <span>JavaScript</span>
                        <button class="copy-btn" onclick="copyCode(this)">Copy Code</button>
                    </div>
                    <pre><code>const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);</code></pre>
                </div>
            </div>
            
            <div class="demo-container">
                <h3>4. Geometry</h3>
                <p>Geometries define the shape of 3D objects. Three.js provides many built-in geometries like Box, Sphere, Cylinder, etc.</p>
                <div class="code-block">
                    <div class="code-header">
                        <span>JavaScript</span>
                        <button class="copy-btn" onclick="copyCode(this)">Copy Code</button>
                    </div>
                    <pre><code>const geometry = new THREE.BoxGeometry(1, 1, 1);</code></pre>
                </div>
            </div>
            
            <div class="demo-container">
                <h3>5. Material</h3>
                <p>Materials define the appearance of objects. They can be simple colors, textures, or complex shaders.</p>
                <div class="code-block">
                    <div class="code-header">
                        <span>JavaScript</span>
                        <button class="copy-btn" onclick="copyCode(this)">Copy Code</button>
                    </div>
                    <pre><code>const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });</code></pre>
                </div>
            </div>
            
            <div class="demo-container">
                <h3>6. Mesh</h3>
                <p>A mesh is an object that takes a geometry and applies a material to it, which can then be added to the scene.</p>
                <div class="code-block">
                    <div class="code-header">
                        <span>JavaScript</span>
                        <button class="copy-btn" onclick="copyCode(this)">Copy Code</button>
                    </div>
                    <pre><code>const cube = new THREE.Mesh(geometry, material);
scene.add(cube);</code></pre>
                </div>
            </div>
            
            <h2>Your First Three.js Scene</h2>
            <p>Let's put it all together to create a simple rotating cube:</p>
            
            <div class="code-block">
                <div class="code-header">
                    <span>JavaScript</span>
                    <button class="copy-btn" onclick="copyCode(this)">Copy Code</button>
                </div>
                <pre><code>// Set up the scene, camera, and renderer
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

// Create a cube
const geometry = new THREE.BoxGeometry(1, 1, 1);
const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
const cube = new THREE.Mesh(geometry, material);
scene.add(cube);

camera.position.z = 5;

// Animation loop
function animate() {
    requestAnimationFrame(animate);
    
    cube.rotation.x += 0.01;
    cube.rotation.y += 0.01;
    
    renderer.render(scene, camera);
}

animate();</code></pre>
            </div>
            
            <h2>Interactive Demo</h2>
            <p>Try this simple Three.js demo. You can rotate the cube and change its properties:</p>
            
            <div class="demo-container">
                <div id="three-demo"></div>
                <div class="demo-controls">
                    <button class="demo-btn" onclick="changeColor()">Change Color</button>
                    <button class="demo-btn" onclick="toggleRotation()">Toggle Rotation</button>
                    <button class="demo-btn" onclick="changeShape('box')">Box</button>
                    <button class="demo-btn" onclick="changeShape('sphere')">Sphere</button>
                    <button class="demo-btn" onclick="changeShape('cone')">Cone</button>
                </div>
            </div>
            
            <h2>Adding Lights</h2>
            <p>To make objects look more realistic, you need to add lights to your scene. Three.js provides several types of lights:</p>
            
            <div class="code-block">
                <div class="code-header">
                    <span>JavaScript</span>
                    <button class="copy-btn" onclick="copyCode(this)">Copy Code</button>
                </div>
                <pre><code>// Ambient light (affects all objects equally)
const ambientLight = new THREE.AmbientLight(0x404040);
scene.add(ambientLight);

// Directional light (like sunlight)
const directionalLight = new THREE.DirectionalLight(0xffffff, 0.5);
directionalLight.position.set(1, 1, 1);
scene.add(directionalLight);

// Point light (like a light bulb)
const pointLight = new THREE.PointLight(0xff0000, 1, 100);
pointLight.position.set(5, 5, 5);
scene.add(pointLight);</code></pre>
            </div>
            
            <h2>Loading 3D Models</h2>
            <p>Three.js can load 3D models in various formats. Here's how to load a GLTF model:</p>
            
            <div class="code-block">
                <div class="code-header">
                    <span>JavaScript</span>
                    <button class="copy-btn" onclick="copyCode(this)">Copy Code</button>
                </div>
                <pre><code>import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

const loader = new GLTFLoader();
loader.load('model.gltf', function (gltf) {
    scene.add(gltf.scene);
}, undefined, function (error) {
    console.error(error);
});</code></pre>
            </div>
            
            <h2>Performance Considerations</h2>
            <p>3D graphics can be resource-intensive. Here are some tips for better performance:</p>
            
            <ul>
                <li>Use low-poly models when possible</li>
                <li>Reuse materials and geometries</li>
                <li>Implement level of detail (LOD) for complex models</li>
                <li>Use texture compression</li>
                <li>Limit the number of lights in your scene</li>
            </ul>
            
            <div class="quote">
                "Three.js democratizes 3D graphics on the web, making it accessible to JavaScript developers without deep graphics programming knowledge."
            </div>
            
            <h2>Resources for Learning Three.js</h2>
            <p>To dive deeper into Three.js, check out these resources:</p>
            
            <ul>
                <li><strong>Official Documentation</strong> - threejs.org</li>
                <li><strong>Three.js Journey</strong> - A popular paid course by Bruno Simon</li>
                <li><strong>Discover Three.js</strong> - Free online book by Lewy Blue</li>
                <li><strong>Codecademy</strong> - Learn Three.js course</li>
                <li><strong>YouTube Tutorials</strong> - Many free tutorials available</li>
            </ul>
            
            <h2>Conclusion</h2>
            <p>Three.js opens up a world of possibilities for creating immersive 3D experiences on the web. While there's a learning curve, the library abstracts away much of the complexity of WebGL, making 3D graphics accessible to web developers.</p>
            
            <p>Start with simple projects and gradually incorporate more advanced features like lights, textures, and animations. With practice, you'll be able to create stunning 3D websites that engage and impress your users.</p>
            
            <a href="index.html#blog" class="back-btn"><i class="fas fa-arrow-left"></i> Back to All Articles</a>
        </div>
    </section>

    <!-- Related Posts -->
    <section class="related-posts">
        <div class="container">
            <h2>Related Articles</h2>
            <div class="related-grid">
                <div class="related-post">
                    <div class="related-img">
                        <img src="https://images.unsplash.com/photo-1581276879432-15e50529f34b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Web Development">
                    </div>
                    <div class="related-info">
                        <h3>The Future of Web Development in 2023</h3>
                        <p>Exploring the latest trends and technologies in web development.</p>
                    </div>
                </div>
                
                <div class="related-post">
                    <div class="related-img">
                        <img src="https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="UI/UX Design">
                    </div>
                    <div class="related-info">
                        <h3>UI/UX Principles for Modern Websites</h3>
                        <p>Essential design principles for creating engaging user experiences.</p>
                    </div>
                </div>
                
                <div class="related-post">
                    <div class="related-img">
                        <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1064&q=80" alt="Web Performance">
                    </div>
                    <div class="related-info">
                        <h3>Optimizing Website Performance</h3>
                        <p>Techniques for faster loading and smoother user experiences.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
     <footer>
    <div class="container">
      <div class="social-links">
        <a href="https://github.com/sayedsalman"><i class="fab fa-github"></i></a>
        <a href="https://www.linkedin.com/in/sayed-mahbub-salman-7b71241b5/"><i class="fab fa-linkedin-in"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com/sayedm_salman/"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com/sayedmsalmanchy"><i class="fab fa-facebook"></i></a>
      </div>
      <p>&copy; 2026 Sayed Mahbub Salman. All rights reserved.</p>
    </div>
  </footer>

    <script>
        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: "#00f7ff" },
                shape: { type: "circle" },
                opacity: { value: 0.5, random: true },
                size: { value: 3, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#7700ff",
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: "none",
                    random: true,
                    straight: false,
                    out_mode: "out",
                    bounce: false
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: { enable: true, mode: "repulse" },
                    onclick: { enable: true, mode: "push" },
                    resize: true
                }
            },
            retina_detect: true
        });

        // Three.js 3D Background
        function initThreeJS() {
            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            const renderer = new THREE.WebGLRenderer({ alpha: true });
            renderer.setSize(window.innerWidth, window.innerHeight);
            document.getElementById('three-canvas').appendChild(renderer.domElement);

            // Create geometric objects
            const geometry = new THREE.IcosahedronGeometry(1, 0);
            const material = new THREE.MeshPhongMaterial({ 
                color: 0x00f7ff,
                shininess: 100,
                wireframe: true
            });

            const objects = [];
            for (let i = 0; i < 10; i++) {
                const mesh = new THREE.Mesh(geometry, material);
                mesh.position.x = Math.random() * 20 - 10;
                mesh.position.y = Math.random() * 20 - 10;
                mesh.position.z = Math.random() * 20 - 10;
                mesh.rotation.x = Math.random() * 2 * Math.PI;
                mesh.rotation.y = Math.random() * 2 * Math.PI;
                mesh.rotation.z = Math.random() * 2 * Math.PI;
                mesh.scale.setScalar(Math.random() * 2 + 1);
                scene.add(mesh);
                objects.push(mesh);
            }

            // Add lights
            const ambientLight = new THREE.AmbientLight(0x222255);
            scene.add(ambientLight);
            
            const light = new THREE.DirectionalLight(0xffffff, 1);
            light.position.set(10, 10, 10);
            scene.add(light);

            camera.position.z = 20;

            // Animation
            function animate() {
                requestAnimationFrame(animate);
                
                objects.forEach(obj => {
                    obj.rotation.x += 0.005;
                    obj.rotation.y += 0.01;
                });

                renderer.render(scene, camera);
            }

            animate();

            // Handle window resize
            window.addEventListener('resize', () => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            });
        }

        // Initialize Three.js
        initThreeJS();

        // Three.js Demo
        let demoScene, demoCamera, demoRenderer, demoMesh;
        let isRotating = true;
        let animationId;

        function initDemo() {
            const container = document.getElementById('three-demo');
            
            // Set up the scene
            demoScene = new THREE.Scene();
            
            // Set up the camera
            demoCamera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
            demoCamera.position.z = 5;
            
            // Set up the renderer
            demoRenderer = new THREE.WebGLRenderer({ antialias: true });
            demoRenderer.setSize(container.clientWidth, container.clientHeight);
            container.appendChild(demoRenderer.domElement);
            
            // Add lights
            const ambientLight = new THREE.AmbientLight(0x404040);
            demoScene.add(ambientLight);
            
            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.5);
            directionalLight.position.set(1, 1, 1);
            demoScene.add(directionalLight);
            
            // Create initial geometry (box)
            const geometry = new THREE.BoxGeometry(1.5, 1.5, 1.5);
            const material = new THREE.MeshPhongMaterial({ 
                color: 0x00ff00,
                shininess: 100
            });
            
            demoMesh = new THREE.Mesh(geometry, material);
            demoScene.add(demoMesh);
            
            // Start animation
            animateDemo();
            
            // Handle window resize
            window.addEventListener('resize', () => {
                demoCamera.aspect = container.clientWidth / container.clientHeight;
                demoCamera.updateProjectionMatrix();
                demoRenderer.setSize(container.clientWidth, container.clientHeight);
            });
        }
        
        function animateDemo() {
            animationId = requestAnimationFrame(animateDemo);
            
            if (isRotating) {
                demoMesh.rotation.x += 0.01;
                demoMesh.rotation.y += 0.01;
            }
            
            demoRenderer.render(demoScene, demoCamera);
        }
        
        function changeColor() {
            demoMesh.material.color.setHex(Math.random() * 0xffffff);
        }
        
        function toggleRotation() {
            isRotating = !isRotating;
        }
        
        function changeShape(type) {
            demoScene.remove(demoMesh);
            
            let geometry;
            switch(type) {
                case 'sphere':
                    geometry = new THREE.SphereGeometry(1, 32, 32);
                    break;
                case 'cone':
                    geometry = new THREE.ConeGeometry(1, 2, 32);
                    break;
                default:
                    geometry = new THREE.BoxGeometry(1.5, 1.5, 1.5);
            }
            
            demoMesh = new THREE.Mesh(geometry, demoMesh.material);
            demoScene.add(demoMesh);
        }
        
        function copyCode(button) {
            const codeBlock = button.parentElement.nextElementSibling;
            const text = codeBlock.textContent;
            navigator.clipboard.writeText(text).then(() => {
                button.textContent = 'Copied!';
                setTimeout(() => {
                    button.textContent = 'Copy Code';
                }, 2000);
            });
        }
        
        // Initialize demo when page loads
        window.addEventListener('load', initDemo);
    </script>
</body>
</html>
