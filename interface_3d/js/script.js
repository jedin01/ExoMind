// Verificar se THREE está definido
if (typeof THREE === 'undefined') {
    console.error("Three.js não foi carregado. Verifique a conexão com a internet ou tente outro navegador.");
    alert("Erro: Three.js não foi carregado. Verifique sua conexão com a internet ou tente outro navegador.");
    throw new Error("Three.js não carregado");
}

// Configuração da cena
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 10000);
const renderer = new THREE.WebGLRenderer({ antialias: true });
renderer.setSize(window.innerWidth, window.innerHeight);
renderer.shadowMap.enabled = true;
renderer.shadowMap.type = THREE.PCFSoftShadowMap;
document.getElementById('container').appendChild(renderer.domElement);

// Verificar WebGL
if (!renderer.context) {
    console.error("WebGL não está disponível no seu navegador.");
    alert("WebGL não está disponível. Use um navegador moderno com WebGL habilitado.");
    throw new Error("WebGL não disponível");
}

// Controles
const controls = new THREE.OrbitControls(camera, renderer.domElement);
controls.enableDamping = true;
controls.dampingFactor = 0.25;
controls.minDistance = 50;
controls.maxDistance = 5000;

// Iluminação
const ambientLight = new THREE.AmbientLight(0x333333, 0.4);
scene.add(ambientLight);
const sunLight = new THREE.PointLight(0xffffff, 2, 0);
sunLight.position.set(0, 0, 0);
sunLight.castShadow = true;
scene.add(sunLight);

// Carregador de texturas
const textureLoader = new THREE.TextureLoader();

// Planetas com texturas (URLs públicas) e cores sólidas como fallback
const planets = [
    { name: 'Sol', radius: 20, distance: 0, textureUrl: 'https://www.solarsystemscope.com/textures/download/8k_sun.jpg', color: 0xffd700, emissive: 0xffa500, info: 'O Sol é a estrela central do Sistema Solar. É uma bola de plasma quente alimentada por fusão nuclear no núcleo.' },
    { name: 'Mercúrio', radius: 1, distance: 50, textureUrl: 'https://www.solarsystemscope.com/textures/download/8k_mercury.jpg', color: 0xa9a9a9, info: 'Mercúrio é o planeta mais próximo do Sol e o menor. Superfície craterada como a Lua, com temperaturas extremas de -173°C a 427°C.' },
    { name: 'Vênus', radius: 2, distance: 80, textureUrl: 'https://www.solarsystemscope.com/textures/download/8k_venus_surface.jpg', color: 0xffdab9, info: 'Vênus, o planeta irmão da Terra, tem atmosfera densa de CO₂ e é o mais quente, com 465°C. Rotação retrógrada.' },
    { name: 'Terra', radius: 2.5, distance: 110, textureUrl: 'https://www.solarsystemscope.com/textures/download/8k_earth_daymap.jpg', color: 0x00bfff, info: 'A Terra é o único planeta com vida conhecida. 71% de oceanos, atmosfera rica em O₂, e um dia de 24 horas.' },
    { name: 'Marte', radius: 2, distance: 150, textureUrl: 'https://www.solarsystemscope.com/textures/download/8k_mars.jpg', color: 0xb22222, info: 'Marte, o planeta vermelho, tem o vulcão mais alto (Olympus Mons) e evidências de rios antigos. Diâmetro: 6.779 km.' },
    { name: 'Júpiter', radius: 10, distance: 250, textureUrl: 'https://www.solarsystemscope.com/textures/download/8k_jupiter.jpg', color: 0xdeb887, info: 'Júpiter é o maior planeta, um gigante gasoso com 79 luas. A Grande Mancha Vermelha é uma tempestade de 300 anos.' },
    { name: 'Saturno', radius: 8, distance: 350, textureUrl: 'https://www.solarsystemscope.com/textures/download/8k_saturn.jpg', ringTextureUrl: 'https://www.solarsystemscope.com/textures/download/8k_saturn_ring_alpha.png', color: 0xf4a460, info: 'Saturno é famoso por seus anéis de gelo e rocha. Segundo maior, com 82 luas e densidade menor que a água.' },
    { name: 'Urano', radius: 5, distance: 450, textureUrl: 'https://www.solarsystemscope.com/textures/download/2k_uranus.jpg', color: 0xadd8e6, info: 'Urano é um gigante de gelo com rotação lateral (deitado). Temperatura: -224°C, 27 luas e anéis fracos.' },
    { name: 'Netuno', radius: 5, distance: 550, textureUrl: 'https://www.solarsystemscope.com/textures/download/2k_neptune.jpg', color: 0x00008b, info: 'Netuno, o mais distante, tem ventos de 2.100 km/h e 14 luas. Descoberto em 1846 por discrepâncias em Urano.' }
];

// Criar planetas
const planetMeshes = [];
planets.forEach(planet => {
    const geometry = new THREE.SphereGeometry(planet.radius, 32, 32);
    let material;
    try {
        const texture = textureLoader.load(
            planet.textureUrl,
            () => console.log(`Textura carregada: ${planet.name}`),
            undefined,
            (err) => {
                console.error(`Erro ao carregar textura para ${planet.name}: ${err}`);
                // Fallback para cor sólida
                material = planet.name === 'Sol' 
                    ? new THREE.MeshBasicMaterial({ color: planet.color, emissive: planet.emissive || 0x000000 })
                    : new THREE.MeshStandardMaterial({ color: planet.color });
            }
        );
        material = planet.name === 'Sol' 
            ? new THREE.MeshBasicMaterial({ map: texture })
            : new THREE.MeshStandardMaterial({ map: texture });
    } catch (e) {
        console.error(`Erro ao criar material para ${planet.name}: ${e}`);
        material = planet.name === 'Sol' 
            ? new THREE.MeshBasicMaterial({ color: planet.color, emissive: planet.emissive || 0x000000 })
            : new THREE.MeshStandardMaterial({ color: planet.color });
    }
    const mesh = new THREE.Mesh(geometry, material);
    mesh.castShadow = true;
    mesh.receiveShadow = true;
    if (planet.distance > 0) {
        mesh.position.x = planet.distance;
    }
    mesh.userData = { 
        name: planet.name, 
        info: planet.info, 
        orbitSpeed: Math.random() * 0.02 + 0.002, 
        rotationSpeed: Math.random() * 0.01 + 0.001, 
        angle: Math.random() * Math.PI * 2 
    };
    scene.add(mesh);
    planetMeshes.push(mesh);

    // Anéis de Saturno
    if (planet.name === 'Saturno') {
        let ringMaterial;
        try {
            const ringTexture = textureLoader.load(
                planet.ringTextureUrl,
                () => console.log('Textura dos anéis de Saturno carregada'),
                undefined,
                (err) => console.error(`Erro ao carregar textura dos anéis de Saturno: ${err}`)
            );
            ringMaterial = new THREE.MeshBasicMaterial({ 
                map: ringTexture, 
                side: THREE.DoubleSide, 
                transparent: true 
            });
        } catch (e) {
            console.error(`Erro ao criar material dos anéis de Saturno: ${e}`);
            ringMaterial = new THREE.MeshBasicMaterial({ 
                color: 0xffffff, 
                side: THREE.DoubleSide, 
                transparent: true, 
                opacity: 0.6 
            });
        }
        const ringGeometry = new THREE.RingGeometry(planet.radius * 1.2, planet.radius * 2, 64);
        const ringMesh = new THREE.Mesh(ringGeometry, ringMaterial);
        ringMesh.rotation.x = Math.PI / 2;
        mesh.add(ringMesh);
    }
});

// Estrelas de fundo
const starsGeometry = new THREE.BufferGeometry();
const starsMaterial = new THREE.PointsMaterial({ color: 0xffffff, size: 0.5 });
const starsVertices = [];
for (let i = 0; i < 10000; i++) {
    starsVertices.push(
        (Math.random() - 0.5) * 2000,
        (Math.random() - 0.5) * 2000,
        (Math.random() - 0.5) * 2000
    );
}
starsGeometry.setAttribute('position', new THREE.Float32BufferAttribute(starsVertices, 3));
const stars = new THREE.Points(starsGeometry, starsMaterial);
scene.add(stars);

// Posição inicial da câmera
camera.position.set(0, 100, 300);
controls.target.set(0, 0, 0);

// Raycaster para cliques em planetas
const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();
window.addEventListener('click', (event) => {
    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
    raycaster.setFromCamera(mouse, camera);
    const intersects = raycaster.intersectObjects(planetMeshes, true);
    if (intersects.length > 0) {
        let planet = intersects[0].object;
        while (planet.userData.name === undefined && planet.parent) {
            planet = planet.parent;
        }
        if (planet.userData.name) {
            document.getElementById('planetName').textContent = planet.userData.name;
            document.getElementById('planetInfo').textContent = planet.userData.info;
            document.getElementById('planetModal').style.display = 'flex';
        }
    }
});

// Fechar modal
document.querySelector('.close').addEventListener('click', () => {
    document.getElementById('planetModal').style.display = 'none';
});
window.addEventListener('click', (e) => {
    if (e.target === document.getElementById('planetModal')) {
        document.getElementById('planetModal').style.display = 'none';
    }
});

// Loop de animação
function animate() {
    requestAnimationFrame(animate);
    controls.update();
    planetMeshes.forEach((mesh, index) => {
        if (planets[index].name !== 'Sol') {
            mesh.userData.angle += mesh.userData.orbitSpeed;
            const distance = planets[index].distance;
            mesh.position.x = Math.cos(mesh.userData.angle) * distance;
            mesh.position.z = Math.sin(mesh.userData.angle) * distance;
        }
        mesh.rotation.y += mesh.userData.rotationSpeed;
    });
    renderer.render(scene, camera);
}
animate();

// Redimensionar janela
window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});

// Log de inicialização para depuração
console.log("Sistema Solar 3D inicializado com sucesso!");